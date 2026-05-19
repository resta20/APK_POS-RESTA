@extends('layouts.app')

@section('title','produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('admin.produk.create') }}" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('admin.produk.index') }}" method="GET">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search nama produk"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>User</th>
      <th>Foto</th>
      <th>Nama</th>
      <th>Harga Beli</th>
      <th>Harga Jual</th>
      <th>Stok</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($products as $product)
    <tr>
        <th>{{ $products->firstItem() + $loop->index }}</th>

        <td>{{ $product->user?->name }}</td>

        <td>
            <img src="{{ asset('storage/'.$product->foto) }}"
                 width="100"
                 class="img-thumbnail">
        </td>

        <td>{{ $product->nama }}</td>
        <td>{{ $product->harga_beli }}</td>
        <td>{{ $product->harga_jual }}</td>
        <td>{{ $product->stok }}</td>

        <td class="d-flex gap-1">

            @can('update', $product)
            <a href="{{ route('admin.produk.edit', $product) }}"
               class="btn btn-sm btn-warning">
               Edit
            </a>
            @endcan

            @can('delete', $product)
            <form action="{{ route('admin.produk.destroy', $product) }}"
                  method="POST"
                  class="d-inline">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                    Hapus
                </button>
            </form>
            @endcan

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