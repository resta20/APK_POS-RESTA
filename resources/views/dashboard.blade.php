<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten -->
@section('content')


    <style>
        body {
            background: #f5f1e8;
        }

        .page-heading {
            color: #4a3728;
            font-weight: 700;
        }

        .page-heading small {
            color: #a68a72 !important;
            font-weight: 400;
        }

        .section-title {
            color: #4a3728;
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .dashboard-card {
            border: 1px solid #e6dccb;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(90, 70, 50, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
            background-color: #ffffff;
        }

        .dashboard-card .card-header {
            background-color: #f0e8da;
            color: #a67c52;
            font-weight: 600;
            font-size: 0.85rem;
            border-bottom: none;
            padding: 0.9rem 1.1rem;
        }

        .dashboard-card .card-body {
            padding: 1.1rem;
        }

        .dashboard-card .card-title {
            color: #4a3728;
            font-weight: 700;
            margin: 0;
        }

        .dashboard-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(90, 70, 50, 0.06);
        }

        .dashboard-table thead {
            background-color: #f0e8da;
        }

        .dashboard-table thead th {
            color: #a67c52;
            font-weight: 600;
            font-size: 0.85rem;
            border-bottom: none;
        }

        .dashboard-table tbody td {
            color: #4a3728;
            vertical-align: middle;
        }

        .dashboard-table .text-muted {
            color: #a68a72 !important;
        }

        .pagination .page-link {
            color: #a67c52;
            border: 1px solid #e6dccb;
        }

        .pagination .page-item.active .page-link {
            background-color: #a67c52;
            border-color: #a67c52;
        }

        .pagination .page-link:hover {
            background-color: #f0e8da;
            color: #4a3728;
        }
    </style>

    <div class="text-center">
        <h1 class="page-heading mt-5">
            Ringkasan Hari Ini
            <small class="text-muted">
                ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})

            </small>
        </h1>
        <div class="row">
            @can('viewAny', App\Models\User::class)
                <div class="col-md-12">
                    <h1 class="section-title">Today's Sales</h1>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            Total Nilai Penjualan Hari Ini
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            Jumlah Transaksi Hari Ini
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $ringkasan['total_transaksi'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <h1 class="section-title">Cash & Payment Status</h1>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            Total Pembayaran tunai
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($ringkasan['total_cash']) }}</h5>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="card-header">
                            Total pembayaran non-tunai
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ number_format($ringkasan['total_non_tunai']) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        <div class="row mt-5">
            <div class="col-md-12">
                <h1 class="section-title">Critical Inventory Status</h1>
            </div>
            <div class="col-md-6">
                <h3 class="section-title" style="font-size: 1.1rem;">Daftar produk stok rendah</h3>
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
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
                                    Seluruh produk berada dalam stok aman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $produkStokRendah->links() }}
            </div>
            <div class="col-md-6">
                <h3 class="section-title" style="font-size: 1.1rem;">Produk habis stok</h3>
                <table class="table dashboard-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Stok</th>
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
                                    Seluruh produk berada dalam stok aman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $produkStokRendah->links() }}
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h1 class="section-title">Best Seller Products</h1>
        </div>
        <div class="col-md-12 text-center">
            <table class="table dashboard-table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
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
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    </div>




    <form method="POST" action="{{ route('logout') }}">
        @csrf
    </form>

    <!-- batas akhir isi konten -->
@endsection
