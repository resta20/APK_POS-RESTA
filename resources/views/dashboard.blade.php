@extends('layouts.app')

@section('title', 'dashboard')

@section('content')

@include('layouts.navbar')

<div class="text-center">
    <h1>
    Ringkasan Hari Ini
    <small class="text-muted">
        ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
    </small>
</h1>
    <div class="row">
        @can('viewAny', App\Models\User::class)
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Total Nilai Penjualan Hari ini
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Jumlah Transaksi Hari Ini
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $ringkasan['total_transaksi'] }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran Tunai
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_cash']) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran Non-Tunai
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5>
                </div>
            </div>
        </div>
    </div>
@endcan
    <div class="row mt-3">
        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>

        <!-- STOK RENDAH -->
        <div class="col-md-6">
            <h3>Daftar produk stok rendah</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkStokRendah as $index => $produk)
                        <tr>
                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $produkStokRendah->links() }}
        </div>

        <!-- STOK HABIS -->
        <div class="col-md-6">
            <h3>Produk habis stok</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkStokHabis as $index => $produk)
                        <tr>
                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $produkStokHabis->links() }}
        </div>
    </div>

    <!-- PRODUK TERLARIS -->
    <div class="row">
        <div class="col-md-12">
            <h1>Best Seller Products</h1>
        </div>

        <div class="col-md-12">
            <table class="table">
                <thead>
    <tr>
        <th scope="col">Nama</th>
        <th scope="col">Stock</th>
        <th scope="col">Unit Terjual</th>
    </tr>
</thead>
<tbody>
    @forelse ($produkTerlaris as $produk)
        <tr>
            <td>{{ $produk->nama }}</td>
            <td>{{ $produk->stok }}</td>
            <td>{{ $produk->total_terjual }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-muted text-center">
                Seluruh Produk berada dalam kondisi aman.
            </td>
        </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>
<form action="{{ route('logout') }}" method="POST">
    @csrf
</form>

@endsection