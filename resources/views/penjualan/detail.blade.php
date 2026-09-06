@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

    <style>
        h1 {
            color: #4a3728;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .btn-primary {
            background-color: #a67c52;
            border-color: #a67c52;
            color: #fffdf9;
        }

        .btn-primary:hover {
            background-color: #8f6a45;
            border-color: #8f6a45;
            color: #fffdf9;
        }

        .table {
            color: #4a3728;
        }

        .table thead th {
            color: #4a3728;
            border-bottom: 2px solid #e6dccb;
            font-weight: 700;
        }

        .table tbody td {
            border-bottom: 1px solid #ecdfc9;
            vertical-align: middle;
        }

        .info-card {
            background-color: #fffdf9;
            border: 1px solid #e6dccb;
            border-radius: 8px;
            padding: 1.25rem 1.5rem;
        }

        .info-label {
            color: #8f6a45;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .info-value {
            color: #4a3728;
            font-weight: 600;
            font-size: 1.05rem;
        }

        .badge-status {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge-completed {
            background-color: #e5f3e0;
            color: #3f7d33;
        }

        .badge-open {
            background-color: #fdf1de;
            color: #a67c30;
        }

        .total-row td {
            font-weight: 700;
            font-size: 1.1rem;
            border-top: 2px solid #e6dccb;
            border-bottom: none !important;
        }

        .produk-img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e6dccb;
            background-color: #fdf6ea;
        }

        .produk-img-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 6px;
            border: 1px solid #e6dccb;
            background-color: #fdf6ea;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c9b691;
            font-size: 0.7rem;
        }

        .produk-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
    </style>

    <h1 class="mb-3">Detail Penjualan</h1>

    <div class="info-card mb-4">
        <div class="row">
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="info-label">Tanggal Transaksi</div>
                <div class="info-value">{{ $penjualan->created_at->translatedFormat('d-m-Y H:i:s') }}</div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="info-label">Kasir</div>
                <div class="info-value">{{ $penjualan->user->name }}</div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="info-label">Metode Pembayaran</div>
                <div class="info-value">{{ $penjualan->metode_pembayaran }}</div>
            </div>
            <div class="col-md-3">
                <div class="info-label">Status</div>
                <span class="badge-status {{ $penjualan->status === 'COMPLETED' ? 'badge-completed' : 'badge-open' }}">
                    {{ $penjualan->status }}
                </span>
            </div>
        </div>
    </div>

    <h5 class="mb-3" style="color:#4a3728; font-weight:700;">Daftar Item</h5>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Harga Satuan</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @forelse($penjualan->itempenjualan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <td>
    <div class="produk-cell">
        @if ($item->produk && $item->produk->foto)
            <img src="{{ Storage::url($item->produk->foto) }}" alt="{{ $item->produk->nama }}" class="produk-img">
        @else
            <div class="produk-img-placeholder">N/A</div>
        @endif
        <span>{{ $item->produk->nama ?? '-' }}</span>
    </div>
</td>
                    
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->kuantitas }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada item</td>
                </tr>
            @endforelse

            <tr class="total-row">
                <td colspan="4" class="text-end">Total Pembayaran</td>
                <td>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary mt-3" style="border:1px solid #e6dccb; color:#4a3728;">
        Kembali
    </a>

@endsection