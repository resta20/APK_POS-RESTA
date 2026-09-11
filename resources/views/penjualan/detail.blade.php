@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('penjualan-body')

    <style>
        .table { color: #4a3f35; }
        .table thead th { color: #4a3f35; border-bottom: 2px solid #f0d6d6; font-weight: 700; }
        .table tbody td { border-bottom: 1px solid #f2dcdc; vertical-align: middle; }

        .info-card {
            background-color: #fdf8f0;
            border: 1px solid #f0d6d6;
            border-radius: 8px;
            padding: 1.25rem 1.5rem;
        }
        .info-label {
            color: #d17d8c;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .info-value { color: #4a3f35; font-weight: 600; font-size: 1.05rem; }

        .badge-status {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .badge-completed { background-color: #e8f0e3; color: #5f7a52; }
        .badge-open { background-color: #fbeed9; color: #a3792f; }

        .total-row td {
            font-weight: 700;
            font-size: 1.1rem;
            border-top: 2px solid #f0d6d6;
            border-bottom: none !important;
        }

        .produk-img {
            width: 48px; height: 48px; object-fit: cover;
            border-radius: 6px; border: 1px solid #f0d6d6; background-color: #fdf3f3;
        }
        .produk-img-placeholder {
            width: 48px; height: 48px; border-radius: 6px;
            border: 1px solid #f0d6d6; background-color: #fdf3f3;
            display: flex; align-items: center; justify-content: center;
            color: #dcb8b8; font-size: 0.7rem;
        }
        .produk-cell { display: flex; align-items: center; gap: 0.75rem; }
    </style>

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

        @if ($penjualan->metode_pembayaran === 'CASH' && !is_null($penjualan->uang_diterima))
            <hr style="border-color:#f0d6d6;">
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="info-label">Uang Diterima</div>
                    <div class="info-value">Rp {{ number_format($penjualan->uang_diterima, 0, ',', '.') }}</div>
                </div>
                <div class="col-md-3">
                    <div class="info-label">Kembalian</div>
                    <div class="info-value">Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</div>
                </div>
            </div>
        @endif
    </div>

    <h5 class="mb-3" style="color:#4a3f35; font-weight:700;">Daftar Item</h5>

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

@endsection

@section('content')

    <h1 class="mb-3" style="color:#4a3f35; font-weight:700;">Detail Penjualan</h1>

    @yield('penjualan-body')

    <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary mt-3" style="border:1px solid #f0d6d6; color:#4a3f35;">
        Kembali
    </a>

@endsection