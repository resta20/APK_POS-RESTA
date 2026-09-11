@extends('layouts.app')

@section('title', 'Users')

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

    .search-card {
        background-color: #fdf8f0;
        border: 1px solid #faeaea;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: 1px solid #f0d6d6;
        border-radius: 8px 0 0 8px;
        background-color: #fdf8f0;
    }
    .form-control:focus {
        border-color: #e29aa4;
        box-shadow: 0 0 0 0.2rem rgba(226, 154, 164, 0.2);
    }

    .btn-outline-secondary {
        border: 1px solid #f0d6d6;
        border-radius: 0 8px 8px 0;
        color: #4a3f35;
        background-color: transparent;
    }
    .btn-outline-secondary:hover {
        background-color: #e29aa4;
        border-color: #e29aa4;
        color: #fdf8f0;
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

    .role-badge {
        display: inline-block;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: capitalize;
    }
    .role-badge.admin {
        background-color: #fbeaea;
        color: #b8863a;
    }
    .role-badge.kasir {
        background-color: #e8f0e3;
        color: #7c9470;
    }

    .empty-state {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #8a7d72;
    }
</style>

<div class="page-header d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
    <div>
        <h1>Users</h1>
    
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        Create
    </a>
</div>

<div class="search-card">
    <form action="{{ route('admin.users.index') }}" method="GET">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Cari username atau email"
            >
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>
</div>

<div class="data-card">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" style="width:60px;">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col" style="width:120px;">Role</th>
          <th scope="col" class="text-end" style="width:220px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
        <tr>
            <td class="text-muted">{{ $users->firstItem() + $loop->index }}</td>
            <td class="fw-semibold">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="role-badge {{ strtolower($user->role->name) }}">
                    {{ $user->role->name }}
                </span>
            </td>
            <td>
                <div class="d-flex gap-1 align-items-center justify-content-end">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                        Edit Akun
                    </a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                <div class="empty-state">
                    <h5 class="mb-1" style="color:#4a3f35;">Data tidak tersedia</h5>
                    <p class="mb-0">Belum ada user yang cocok dengan pencarian.</p>
                </div>
            </td>
        </tr>
        @endforelse
      </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $users->links() }}
</div>

@endsection