@extends('layouts.app')

@section('title', 'Penjualan')

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

        .btn-warning {
            color: #fffdf9;
        }

        .btn-warning:hover {
            color: #fffdf9;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Penjualan</h1>
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Create</a>
    </div>

    <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                placeholder="Search penjualan">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kasir</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sales->firstItem() + $loop->index }}</td>
                        <td>{{ optional($sale->created_at)->translatedFormat('d-m-Y H:i:s') }}</td>
                        <td>{{ optional($sale->user)->name ?? '-' }}</td>
                        <td>Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ $sale->metode_pembayaran }}</td>
                        <td>
                            <span class="badge {{ $sale->status === 'OPEN' ? 'bg-secondary' : 'bg-success' }}">
                                {{ $sale->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 align-items-center">
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
                        <td colspan="7" class="text-center py-4">Data Tidak Ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $sales->withQueryString() }}
    </div>

@endsection 