@extends('layouts.app')

@section('title','produk')

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

    .produk-photo {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e6dccb;
    }

    .btn-warning {
        color: #fffdf9;
    }
    .btn-warning:hover {
        color: #fffdf9;
    }
</style>


<h1>Halaman Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari nama produk"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Cari
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
        <td>{{ $products->firstItem() + $loop->index }}</td>
        <td>{{ $product->user?->name }}</td>
        <td>
            <img src="{{ asset('storage/'.$product->foto) }}" class="produk-photo">
        </td>
        <td>{{ $product->nama }}</td>
        <td>Rp {{ number_format($product->harga_beli) }}</td>
        <td>Rp {{ number_format($product->harga_jual) }}</td>
        <td>{{ $product->stok }}</td>
        <td>
            <div class="d-flex gap-1 align-items-center">
                @can('update', $product)
                <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>
                @endcan

                @can('delete', $product)
                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                        Hapus
                    </button>
                </form>
                @endcan
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center">
            <h5>Data tidak tersedia.</h5>
        </td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $products->links() }}

@endsection