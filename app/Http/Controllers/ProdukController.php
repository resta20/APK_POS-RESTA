<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        $products = Produk::with(['user', 'jenis']) // Eager loading relasi jenis
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);
        $jenisList = Jenis::all(); // Mengambil pilihan jenis

        return view('produk.create', compact('jenisList'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $dataReq['jenis_id'], // Tambahkan jenis_id
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);
        $jenisList = Jenis::all(); // Mengambil pilihan jenis

        return view('produk.edit', compact('produk', 'jenisList'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $dataReq['jenis_id'], // Update jenis_id
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Product updated successfully.');
    }

    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        return view('produk.detail', compact('produk'));
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Product deleted successfully.');
    }
}