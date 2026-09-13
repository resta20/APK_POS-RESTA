@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

<style>
    .page-header h1 {
        color: #4a3f35;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.25rem;
    }
    .page-header p {
        color: #8a7d72;
        margin-bottom: 0;
    }

    .btn-primary {
        background-color: #b98a8f;
        border-color: #b98a8f;
        color: #fdf8f0;
    }
    .btn-primary:hover {
        background-color: #a3767b;
        border-color: #a3767b;
        color: #fdf8f0;
    }

    .search-card {
        background-color: #fdf8f0;
        border: 1px solid #ece4dd;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: 1px solid #e5dcd3;
        border-radius: 6px 0 0 6px;
        background-color: #fdf8f0;
    }
    .form-control:focus {
        border-color: #b98a8f;
        box-shadow: 0 0 0 0.2rem rgba(185, 138, 143, 0.15);
    }

    .btn-outline-secondary {
        border: 1px solid #e5dcd3;
        border-radius: 0 6px 6px 0;
        color: #4a3f35;
        background-color: transparent;
    }
    .btn-outline-secondary:hover {
        background-color: #b98a8f;
        border-color: #b98a8f;
        color: #fdf8f0;
    }

    .data-card {
        background-color: #fff;
        border: 1px solid #ece4dd;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(74, 63, 53, 0.05);
        overflow: hidden;
    }

    .table {
        color: #4a3f35;
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #f4efe9;
        color: #4a3f35;
        border-bottom: 2px solid #e5dcd3;
        font-weight: 700;
        padding-top: 0.9rem;
        padding-bottom: 0.9rem;
        white-space: nowrap;
    }

    .table tbody tr:hover {
        background-color: #fbf7f2;
    }

    .table tbody td {
        border-bottom: 1px solid #ece4dd;
        vertical-align: middle;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    .table td:first-child, .table th:first-child { padding-left: 1.25rem; }
    .table td:last-child, .table th:last-child { padding-right: 1.25rem; }

    .btn-warning {
        background-color: #b98a8f;
        border-color: #b98a8f;
        color: #fdf8f0;
    }
    .btn-warning:hover {
        background-color: #a3767b;
        border-color: #a3767b;
        color: #fdf8f0;
    }

    .btn-danger {
        background-color: #8f5f64;
        border-color: #8f5f64;
    }
    .btn-danger:hover {
        background-color: #7a4f53;
        border-color: #7a4f53;
    }

    .badge.bg-secondary {
        background-color: #ece4dd !important;
        color: #4a3f35 !important;
        font-weight: 600;
    }
    .badge.bg-success {
        background-color: #7c9470 !important;
        font-weight: 600;
    }

    .empty-state {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #8a7d72;
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
                                <button type="button"
                                    class="btn btn-primary btn-sm btn-detail-penjualan"
                                    data-url="{{ route('penjualan.show', $sale) }}">
                                    Detail
                                </button>
                                @if ($sale->status === 'OPEN' && Auth::check() && optional(Auth::user()->role)->name === 'admin')
                                    <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline js-confirm-delete"
                                        data-confirm-title="Batalkan transaksi ini?"
                                        data-confirm-text="Transaksi ini akan dihapus dan stok produk akan dikembalikan.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
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
                                <h5 class="mb-1" style="color:#4a3f35;">Data tidak ditemukan</h5>
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

{{-- Modal Detail Penjualan --}}
<div class="modal fade" id="detailPenjualanModal" tabindex="-1" aria-labelledby="detailPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:1px solid #e5dcd3;">
                <h5 class="modal-title" id="detailPenjualanModalLabel" style="color:#4a3f35; font-weight:700;">
                    Detail Penjualan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailPenjualanBody">
                <div class="text-center py-5">
                    <div class="spinner-border" role="status" style="color:#b98a8f;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-detail-penjualan');
        if (!btn) return;

        const url = btn.dataset.url;
        const modalEl = document.getElementById('detailPenjualanModal');
        const body = document.getElementById('detailPenjualanBody');

        body.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border" role="status" style="color:#b98a8f;"></div>
            </div>`;

        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => {
            if (!res.ok) throw new Error('Gagal memuat data');
            return res.text();
        })
        .then(html => { body.innerHTML = html; })
        .catch(() => {
            body.innerHTML = '<p class="text-danger mb-0">Gagal memuat detail penjualan.</p>';
        });
    });
</script>
@endpush