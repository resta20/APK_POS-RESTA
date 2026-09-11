<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PenjualanController extends Controller
{
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })->orderBy('nama')->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    public function store(Request $request)
    {
        //
    }

   public function show(Request $request, Penjualan $penjualan)
{
    $user = Auth::user();

    if ($user->role->name === 'kasir' && $penjualan->user_id != Auth::id()) {
        abort(403, 'Akses ditolak');
    }

    $penjualan->load(['itemPenjualan.produk', 'user']);

   
    if ($request->ajax()) {
        $sections = view('penjualan.detail', compact('penjualan'))->renderSections();
        return $sections['penjualan-body'];
    }

    return view('penjualan.detail', compact('penjualan'));
}

    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    // Checkout
    public function update(Request $request, string $id)
    {
        $sale = Penjualan::findOrFail($id);
        $user = Auth::user();

        // Kasir hanya boleh checkout transaksi milik sendiri
        if ($user->role->name === 'kasir' && $sale->user_id != Auth::id()) {
            return redirect()->route('penjualan.index')
                ->with('error', 'Akses ditolak');
        }

        // Keranjang tidak boleh kosong
        if ($sale->itempenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong');
        }

        // Pastikan belum di-checkout
        if ($sale->status === 'COMPLETED') {
            return back()->with('error', 'Transaksi sudah selesai');
        }

        $request->validate([
            'metode_pembayaran' => 'required|in:CASH,QRIS',
            'uang_diterima' => 'required_if:metode_pembayaran,CASH|nullable|numeric|min:' . $sale->total_pembayaran,
        ], [
            'uang_diterima.required_if' => 'Uang diterima wajib diisi untuk pembayaran Cash.',
            'uang_diterima.min' => 'Uang diterima tidak boleh kurang dari total pembayaran.',
        ]);

        $data = [
            'status'            => 'COMPLETED',
            'metode_pembayaran' => $request->metode_pembayaran,
        ];

        if ($request->metode_pembayaran === 'CASH') {
            $data['uang_diterima'] = $request->uang_diterima;
            $data['kembalian']     = $request->uang_diterima - $sale->total_pembayaran;
        } else {
            $data['uang_diterima'] = null;
            $data['kembalian']     = null;
        }

        $sale->update($data);

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    // Batal / Hapus Transaksi
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        $sale = $penjualan;
        $user = Auth::user();

        // Kasir hanya boleh hapus transaksi milik sendiri, admin bebas
        if ($user->role->name === 'kasir' && $sale->user_id != Auth::id()) {
            return redirect()->route('penjualan.index')
                ->with('error', 'Akses ditolak');
        }

        // Transaksi COMPLETED tidak bisa dihapus
        if ($sale->status === 'COMPLETED') {
            return redirect()->route('penjualan.index')
                ->with('error', 'Transaksi yang sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($sale) {
            foreach ($sale->itempenjualan as $item) {
                $item->produk->increment('stok', $item->kuantitas);
            }
            $sale->itempenjualan()->delete();
            $sale->delete();
        });

        return redirect()->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}