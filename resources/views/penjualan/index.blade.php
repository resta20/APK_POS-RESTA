@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

<style>
    .page-header h1 {
        color: #4a3728;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.25rem;
    }
    .page-header p {
        color: #9c8974;
        margin-bottom: 0;
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

    .search-card {
        background-color: #fffdf9;
        border: 1px solid #f0e6d6;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: 1px solid #e6dccb;
        border-radius: 8px 0 0 8px;
        background-color: #fffdf9;
    }
    .form-control:focus {
        border-color: #a67c52;
        box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.2);
    }

    .btn-outline-secondary {
        border: 1px solid #e6dccb;
        border-radius: 0 8px 8px 0;
        color: #4a3728;
        background-color: transparent;
    }
    .btn-outline-secondary:hover {
        background-color: #a67c52;
        border-color: #a67c52;
        color: #fffdf9;
    }

    .data-card {
        background-color: #fff;
        border: 1px solid #f0e6d6;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(74, 55, 40, 0.06);
        overflow: hidden;
    }

    .table {
        color: #4a3728;
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #faf5eb;
        color: #4a3728;
        border-bottom: 2px solid #e6dccb;
        font-weight: 700;
        padding-top: 0.9rem;
        padding-bottom: 0.9rem;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background-color: #fbf7ef;
    }

    .table tbody td {
        border-bottom: 1px solid #ecdfc9;
        vertical-align: middle;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    .table td:first-child, .table th:first-child { padding-left: 1.25rem; }
    .table td:last-child, .table th:last-child { padding-right: 1.25rem; }

    .btn-warning {
        color: #fffdf9;
    }
    .btn-warning:hover {
        color: #fffdf9;
    }

    .badge.bg-secondary {
        background-color: #e6dccb !important;
        color: #4a3728 !important;
        font-weight: 600;
    }
    .badge.bg-success {
        background-color: #4f7a4f !important;
        font-weight: 600;
    }

    .empty-state {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #9c8974;
    }
</style>

<div class="page-header d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
    <div>
        <h1>Penjualan</h1>
       
    </div>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
         Create
    </a>
</div>

<div class="search-card">
    <form action="{{ route('penjualan.index') }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                placeholder="Cari penjualan">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
</div>

<div class="data-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kasir</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th class="text-end" style="width:220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td class="text-muted">{{ $sales->firstItem() + $loop->index }}</td>
                        <td>{{ optional($sale->created_at)->translatedFormat('d-m-Y H:i:s') }}</td>
                        <td>{{ optional($sale->user)->name ?? '-' }}</td>
                        <td class="fw-semibold">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ $sale->metode_pembayaran }}</td>
                        <td>
                            <span class="badge {{ $sale->status === 'OPEN' ? 'bg-secondary' : 'bg-success' }}">
                                {{ $sale->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 align-items-center justify-content-end">
                                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-primary btn-sm">Detail</a>
                                @if ($sale->status === 'OPEN' && Auth::check() && optional(Auth::user()->role)->name === 'admin')
                                    <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <h5 class="mb-1" style="color:#4a3728;">Data tidak ditemukan</h5>
                                <p class="mb-0">Belum ada transaksi penjualan yang cocok.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $sales->withQueryString()->links() }}
</div>

@endsection