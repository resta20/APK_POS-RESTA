@extends('layouts.app')

@section('title', 'Jenis')

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

<h1>Data Jenis</h1>

<a href="{{ route('jenis.create') }}" class="btn btn-primary mb-3">Create</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Jenis</th>
      <th scope="col">Dibuat Oleh</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($jenis as $item)
    <tr>
        <td>{{ $jenis->firstItem() + $loop->index }}</td>
        <td>{{ $item->nama_jenis }}</td>
        <td>{{ $item->user->name ?? '-' }}</td>
        <td>
            <div class="d-flex gap-1 align-items-center">
                <a href="{{ route('jenis.edit', $item->id) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>
                <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                        Hapus
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="text-center">
            <h5>Data tidak tersedia.</h5>
        </td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $jenis->links() }}

@endsection