@extends('layouts.app')

@section('title', 'Users')

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
    }
    .btn-primary:hover {
        background-color: #8f6a45;
        border-color: #8f6a45;
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

    .table a {
        color: #a67c52;
    }

    .btn-warning {
        background-color: #d9a441;
        border-color: #d9a441;
        color: #fffdf9;
    }
    .btn-warning:hover {
        background-color: #c4922f;
        border-color: #c4922f;
        color: #fffdf9;
    }
</style>

<h1>Halaman Users</h1>

<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create</a>

<form action="{{ route('admin.users.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search username or email"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($users as $user)
    <tr>
        <td>{{ $users->firstItem() + $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        <td>
            <div class="d-flex gap-1 align-items-center">
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
        <td colspan="5" class="text-center">
            <h5>Data tidak tersedia.</h5>
        </td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $users->links() }}

@endsection