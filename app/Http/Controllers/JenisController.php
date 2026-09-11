<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Jenis::class, 'jenis');
    }

    public function index()
    {
        $jenis = Jenis::with('user')->latest()->paginate(10);
        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'user_id'    => auth()->id(),
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diupdate.');
    }

    public function destroy(Jenis $jenis)
    {
        $jumlahProduk = $jenis->produk()->count();

        if ($jumlahProduk > 0) {
            return redirect()->route('jenis.index')
                ->with('error', 'Jenis tidak bisa dihapus karena masih memiliki ' . $jumlahProduk . ' produk terkait. Pindahkan atau hapus produk tersebut terlebih dahulu.');
        }

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}