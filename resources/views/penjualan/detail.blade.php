@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

<style>
    h4 {
        color: #4a3728;
        font-weight: 700;
    }

    .card {
        border: 1px solid #e6dccb;
        border-radius: 10px;
    }

    .info-label {
        color: #9c8c78;
        font-size: 0.8rem;
        margin-bottom: 2px;
    }

    .info-value {
        color: #4a3728;
        font-weight: 600;
        margin-bottom: 14px;
    }

    .badge-status {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
    }

    .badge-open {
        background-color: #f0e8da;
        color: #8f6a45;
    }

    .badge-completed {
        background-color: #e3f0e2;
        color: #3d7a3a;
    }

    .table {
        color: #4a3728;
    }
    .table thead th {
        color: #4a3728;
        border-color: #e6dccb;
        font-weight: 700;
    }
    .table td {
        border-color: #ecdfc9;
        vertical-align: middle;
    }

    .card-footer {
        background-color: #f0e8da;
        border-top: 1px solid #e6dccb;
    }

    .produk-thumb {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e6dccb;
        flex-shrink: 0;
    }

    .btn-secondary {
        background-color: #d8cdbb;
        border-color: #d8cdbb;
        color: #4a3728;
    }
    .btn-secondary:hover {
        background-color: #c9bca5;
        border-color: #c9bca5;
        color: #4a3728;
    }
</style>

<h4 class="mb-3">Detail Transaksi</h4>

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="info-label">Tanggal Transaksi</div>
                <div class="info-value">{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</div>
            </div>
            <div class="col-md-3 col-6">
                <div class="info-label">Kasir</div>
                <div class="info-value">{{ $sale->user->name }}</div>
            </div>
            <div class="col-md-3 col-6">
                <div class="info-label">Metode Pembayaran</div>
                <div class="info-value">{{ $sale->metode_pembayaran }}</div>
            </div>
            <div class="col-md-3 col-6">
                <div class="info-label">Status</div>
                <div class="info-value">
                    <span class="badge-status {{ $sale->status === 'COMPLETED' ? 'badge-completed' : 'badge-open' }}">
                        {{ $sale->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sale->itempenjualan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('storage/'.$item->produk->foto) }}" class="produk-thumb" alt="{{ $item->produk->nama }}">
                        <span>{{ $item->produk->nama }}</span>
                    </div>
                </td>
                <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                <td>{{ $item->kuantitas }}</td>
                <td>Rp {{ number_format($item->subtotal) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-3">
                    Tidak ada produk dalam transaksi ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <strong>Total: Rp {{ number_format($sale->total_pembayaran) }}</strong>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection