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

    public function show(string $id)
    {
        //
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
        $request->validate([
            'metode_pembayaran' => 'required|in:CASH,QRIS',
        ]);

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

        $sale->update([
            'status'            => 'COMPLETED',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

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