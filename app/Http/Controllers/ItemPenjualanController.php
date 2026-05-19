<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemPenjualanController extends Controller
{
    public function index() {}
    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Produk::findOrFail($request->product_id);

        if ($product->stok < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi');
        }

        DB::transaction(function () use ($request, $product) {

            $sale = Penjualan::where('user_id', Auth::id())
                ->where('status', 'OPEN')
                ->firstOrFail();

            $product->decrement('stok', $request->quantity);

            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->first();

            if ($item) {
                $item->kuantitas += $request->quantity;
            } else {
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id'    => $product->id,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            $sale->total_pembayaran = $sale->itempenjualan()->sum('subtotal');
            $sale->save();
        });

        return back();
    }

    // Satu method update saja — duplikat dihapus
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $id) {

            $item    = ItemPenjualan::lockForUpdate()->findOrFail($id);
            $sale    = $item->penjualan;
            $product = $item->produk;

            $selisih = $request->quantity - $item->kuantitas;

            if ($selisih > 0 && $product->stok < $selisih) {
                throw new \Exception('Stok tidak mencukupi');
            }

            // Jika selisih negatif, decrement angka negatif = stok bertambah balik
            $product->decrement('stok', $selisih);

            $item->kuantitas = $request->quantity;
            $item->subtotal  = $item->kuantitas * $item->harga_satuan;
            $item->save();

            $sale->total_pembayaran = $sale->itempenjualan()->sum('subtotal');
            $sale->save();
        });

        return back();
    }

   public function destroy(string $id)
{
    $itempenjualan = ItemPenjualan::findOrFail($id);

    $this->authorize('delete', $itempenjualan);

    DB::transaction(function () use ($itempenjualan) {
        $sale    = $itempenjualan->penjualan;
        $product = $itempenjualan->produk;

        $product->increment('stok', $itempenjualan->kuantitas);
        $itempenjualan->delete();

        $sale->total_pembayaran = $sale->itempenjualan()->sum('subtotal');
        $sale->save();
    });

    return back();
}
}