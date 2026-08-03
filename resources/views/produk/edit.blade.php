@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<style>
    h4 {
        color: #4a3728;
        font-weight: 700;
    }

    label {
        color: #4a3728;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-control {
        border: 1px solid #e6dccb;
        border-radius: 8px;
        background-color: #fffdf9;
    }

    .form-control:focus {
        border-color: #a67c52;
        box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.2);
    }

    .img-thumbnail {
        border: 1px solid #e6dccb;
        border-radius: 8px;
    }

    .btn-success {
        background-color: #a67c52;
        border-color: #a67c52;
    }
    .btn-success:hover {
        background-color: #8f6a45;
        border-color: #8f6a45;
    }

    .btn-secondary {
        background-color: #d8cdbb;
        border-color: #d8cdbb;
        color: #4a3728;
    }
    .btn-secondary:hover {
        background-color: #c9bca5;
        border-color: #c9bca5;
        color: #4a3728;
    }
</style>

<h4>Edit Produk</h4>

<form action="{{ route('produk.update', $produk) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('produk._form')

</form>

@endsection