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
        border: 1px solid #e5dcd3;
        border-radius: 6px;
        background-color: #fdf8f0;
    }

    .form-control:focus {
        border-color: #b98a8f;
        box-shadow: 0 0 0 0.2rem rgba(185, 138, 143, 0.15);
    }

    .img-thumbnail {
        border: 1px solid #e5dcd3;
        border-radius: 6px;
    }

    .btn-success {
        background-color: #b98a8f;
        border-color: #b98a8f;
    }
    .btn-success:hover {
        background-color: #a3767b;
        border-color: #a3767b;
    }

    .btn-secondary {
        background-color: #ece4dd;
        border-color: #ece4dd;
        color: #4a3f35;
    }
    .btn-secondary:hover {
        background-color: #ddd2c7;
        border-color: #ddd2c7;
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