@extends('layouts.app')

@section('title', 'Jenis')

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
        background-color: #e29aa4;
        border-color: #e29aa4;
    }
    .btn-primary:hover {
        background-color: #d17d8c;
        border-color: #d17d8c;
    }

    .data-card {
        background-color: #fff;
        border: 1px solid #faeaea;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(74, 63, 53, 0.06);
        overflow: hidden;
    }

    .table {
        color: #4a3f35;
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #fbeff0;
        color: #4a3f35;
        border-bottom: 2px solid #f0d6d6;
        font-weight: 700;
        padding-top: 0.9rem;
        padding-bottom: 0.9rem;
    }

    .table tbody tr:hover {
        background-color: #fdf5f5;
    }

    .table tbody td {
        border-bottom: 1px solid #f2dcdc;
        vertical-align: middle;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    .table td:first-child, .table th:first-child { padding-left: 1.25rem; }
    .table td:last-child, .table th:last-child { padding-right: 1.25rem; }

    .table a {
        color: #e29aa4;
    }

    .btn-warning {
        background-color: #e0ab4f;
        border-color: #e0ab4f;
        color: #fdf8f0;
    }
    .btn-warning:hover {
        background-color: #b8863a;
        border-color: #b8863a;
        color: #fdf8f0;
    }

    .creator-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .creator-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: #f0d6d6;
        color: #d17d8c;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #8a7d72;
    }
</style>

<div class="page-header d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
    <div>
        <h1>Data Jenis</h1>
       
    </div>
    @can('create', App\Models\Jenis::class)
    <a href="{{ route('jenis.create') }}" class="btn btn-primary">
Create
    </a>
    @endcan
</div>

<div class="data-card">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" style="width:70px;">No</th>
          <th scope="col">Nama Jenis</th>
          <th scope="col">Dibuat Oleh</th>
          <th scope="col" class="text-end" style="width:200px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($jenis as $item)
        <tr>
            <td class="text-muted">{{ $jenis->firstItem() + $loop->index }}</td>
            <td class="fw-semibold">{{ $item->nama_jenis }}</td>
            <td>
                <span class="creator-badge">
                    <span class="creator-avatar">{{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}</span>
                    {{ $item->user->name ?? '-' }}
                </span>
            </td>
            <td>
                <div class="d-flex gap-1 align-items-center justify-content-end">
                    @can('update', $item)
                    <a href="{{ route('jenis.edit', $item->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>
                    @endcan
                    @can('delete', $item)
                    <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                    @endcan
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                <div class="empty-state">
                    <h5 class="mb-1" style="color:#4a3f35;">Data tidak tersedia</h5>
                    <p class="mb-0">Belum ada jenis produk yang ditambahkan.</p>
                </div>
            </td>
        </tr>
        @endforelse
      </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $jenis->links() }}
</div>

@endsection