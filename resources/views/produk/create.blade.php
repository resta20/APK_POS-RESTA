@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<style>
    h4 {
        color: #4a3f35;
        font-weight: 700;
    }

    label {
        color: #4a3f35;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-control {
        border: 1px solid #f0d6d6;
        border-radius: 8px;
        background-color: #fdf8f0;
    }

    .form-control:focus {
        border-color: #e29aa4;
        box-shadow: 0 0 0 0.2rem rgba(226, 154, 164, 0.2);
    }

    .img-thumbnail {
        border: 1px solid #f0d6d6;
        border-radius: 8px;
    }

    .btn-success {
        background-color: #e29aa4;
        border-color: #e29aa4;
    }
    .btn-success:hover {
        background-color: #d17d8c;
        border-color: #d17d8c;
    }

    .btn-secondary {
        background-color: #e9c9c9;
        border-color: #e9c9c9;
        color: #4a3f35;
    }
    .btn-secondary:hover {
        background-color: #dcb8b8;
        border-color: #dcb8b8;
        color: #4a3f35;
    }
</style>

<h4>Tambah Produk</h4>

<form action="{{ route('produk.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @include('produk._form')

</form>

@endsection