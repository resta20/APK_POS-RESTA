@extends('layouts.app')

@section('title','produk')

@section('content')

<style>
    .page-header h1 {
        color: #4a3728;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.25rem;
    }
    .page-header p {
        color: #9c8974;
        margin-bottom: 0;
    }

    .btn-primary {
        background-color: #a67c52;
        border-color: #a67c52;
    }
    .btn-primary:hover {
        background-color: #8f6a45;
        border-color: #8f6a45;
    }

    .search-card {
        background-color: #fffdf9;
        border: 1px solid #f0e6d6;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
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

    .btn-warning {
        color: #fffdf9;
    }
    .btn-warning:hover {
        color: #fffdf9;
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

    /* grid produk ala menu kafe */
    .produk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 18px;
    }

    .produk-card {
        background-color: #fffdf9;
        border: 1px solid #e6dccb;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.15s, transform 0.15s;
    }

    .produk-card:hover {
        box-shadow: 0 6px 16px rgba(74, 55, 40, 0.12);
        transform: translateY(-2px);
    }

    .produk-card-photo {
        width: 100%;
        height: 150px;
        object-fit: cover;
        background-color: #f2ead9;
        display: block;
    }

    .produk-card-photo-placeholder {
        width: 100%;
        height: 150px;
        background-color: #f2ead9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #c9b795;
        font-size: 0.8rem;
    }

    .produk-card-body {
        padding: 14px 16px 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .produk-card-nama {
        font-family: Georgia, 'Times New Roman', serif;
        color: #4a3728;
        font-weight: 600;
        font-size: 1.15rem;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .produk-card-meta {
        color: #9c8c78;
        font-size: 0.78rem;
        margin-bottom: 10px;
    }

    .produk-card-meta strong {
        color: #8f6a45;
    }

    .produk-card-price-row {
        display: flex;
        align-items: baseline;
        gap: 6px;
        border-top: 1px dashed #e6dccb;
        padding-top: 10px;
        margin-bottom: 10px;
    }

    .produk-card-dots {
        flex: 1;
        border-bottom: 1px dotted #d8cdbb;
        margin-bottom: 4px;
    }

    .produk-card-harga {
        font-family: Georgia, 'Times New Roman', serif;
        color: #a67c52;
        font-weight: 700;
        font-size: 1.05rem;
        white-space: nowrap;
    }

    .produk-card-stok {
        display: inline-block;
        font-size: 0.72rem;
        color: #4a3728;
        background-color: #f2ead9;
        border-radius: 20px;
        padding: 2px 10px;
        margin-bottom: 10px;
        width: fit-content;
    }

    .produk-card-aksi {
        margin-top: auto;
        display: flex;
        gap: 6px;
    }

    .produk-card-aksi form {
        flex: 1;
    }

    .produk-card-aksi .btn {
        width: 100%;
        font-size: 0.8rem;
    }

    .produk-empty {
        color: #9c8974;
        text-align: center;
        padding: 60px 0;
        grid-column: 1 / -1;
    }
</style>

<div class="page-header d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
    <div>
        <h1>Produk</h1>
        
    </div>
    @can('create', App\Models\Produk::class)
    <a href="{{ route('produk.create') }}" class="btn btn-primary">
        Create
    </a>
    @endcan
</div>

<div class="search-card">
    <form action="{{ route('produk.index') }}" method="GET">
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
</div>

<div class="produk-grid">
    @forelse ($products as $product)
    <div class="produk-card">
        @if($product->foto)
            <img src="{{ asset('storage/'.$product->foto) }}" class="produk-card-photo" alt="{{ $product->nama }}">
        @else
            <div class="produk-card-photo-placeholder">Tidak ada foto</div>
        @endif
        <div class="produk-card-body">
            <div class="produk-card-nama">{{ $product->nama }}</div>

            <div class="produk-card-meta">
                {{ $product->user?->name }} &middot;
                <strong>{{ $product->jenis?->nama_jenis ?? 'Tanpa Jenis' }}</strong>
            </div>

            <div class="produk-card-price-row">
                <span class="produk-card-dots"></span>
                <span class="produk-card-harga">Rp {{ number_format($product->harga_jual) }}</span>
            </div>

            <span class="produk-card-stok">Stok: {{ $product->stok }}</span>

            <div class="produk-card-aksi">
                <a href="{{ route('produk.show', $product) }}" class="btn btn-sm btn-secondary">
                    Detail
                </a>

                @can('update', $product)
                <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>
                @endcan

                @can('delete', $product)
                <form action="{{ route('produk.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                        Hapus
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>
    @empty
    <div class="produk-empty">
        <h5 style="color:#4a3728;">Data tidak tersedia</h5>
        <p class="mb-0">Belum ada produk yang cocok.</p>
    </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $products->withQueryString()->links() }}
</div>

@endsection