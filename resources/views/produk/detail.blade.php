@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<style>
    h4 {
        color: #4a3f35;
        font-weight: 700;
    }

    .card {
        border: 1px solid #f0d6d6;
        border-radius: 10px;
        background-color: #fdf8f0;
    }

    .produk-detail-photo {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #f0d6d6;
    }

    .info-label {
        color: #8a7d72;
        font-size: 0.8rem;
        margin-bottom: 2px;
    }

    .info-value {
        color: #4a3f35;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 16px;
    }

    .info-value.harga-jual {
        font-size: 1.4rem;
        color: #e29aa4;
    }

    .badge-stok {
        display: inline-block;
        font-size: 0.8rem;
        color: #4a3f35;
        background-color: #fdf0f0;
        border-radius: 20px;
        padding: 4px 14px;
    }

    .btn-warning {
        color: #fdf8f0;
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

<h4 class="mb-3">Detail Produk</h4>

<div class="card">
    <div class="card-body">
        <div class="row g-4">

            <div class="col-md-4">
                <img src="{{ asset('storage/'.$produk->foto) }}" class="produk-detail-photo" alt="{{ $produk->nama }}">
            </div>

            <div class="col-md-8">
                <div class="info-label">Nama Produk</div>
                <div class="info-value" style="font-size:1.2rem">{{ $produk->nama }}</div>

                <div class="row">
                    <div class="col-6">
                        <div class="info-label">Harga Jual</div>
                        <div class="info-value harga-jual">Rp {{ number_format($produk->harga_jual) }}</div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Harga Beli</div>
                        <div class="info-value">Rp {{ number_format($produk->harga_beli) }}</div>
                    </div>
                </div>

                <div class="info-label">Stok Tersedia</div>
                <div class="mb-3">
                    <span class="badge-stok">{{ $produk->stok }} unit</span>
                </div>

                <div class="info-label">Ditambahkan oleh</div>
                <div class="info-value">{{ $produk->user?->name }}</div>

                <div class="d-flex gap-2 mt-3">
                    @can('update', $produk)
                    <a href="{{ route('produk.edit', $produk) }}" class="btn btn-warning">Edit</a>
                    @endcan
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection