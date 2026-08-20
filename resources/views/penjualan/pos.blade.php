@extends('layouts.app')

@section('title', 'POS')

@section('content')

<style>
    h4 {
        color: #4a3728;
        font-weight: 700;
    }

    .card {
        border: 1px solid #e6dccb;
        border-radius: 10px;
    }

    .form-control,
    .form-select {
        border: 1px solid #e6dccb;
        border-radius: 8px;
        background-color: #fffdf9;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #a67c52;
        box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.2);
    }

    .btn-outline-primary {
        color: #4a3728;
        border-color: #e6dccb;
    }
    .btn-outline-primary:hover,
    .btn-outline-primary:active {
        background-color: #f0e8da;
        border-color: #a67c52;
        color: #4a3728;
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
        border-color: #e6dccb;
        font-weight: 700;
    }
    .table td {
        border-color: #ecdfc9;
        vertical-align: middle;
    }

    .card-footer {
        background-color: #f0e8da;
        border-top: 1px solid #e6dccb;
    }

    .btn-success {
        background-color: #a67c52;
        border-color: #a67c52;
    }
    .btn-success:hover {
        background-color: #8f6a45;
        border-color: #8f6a45;
    }

    /* grid produk ala marketplace */
    .produk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 12px;
    }

    .produk-pick-card {
        background-color: #fffdf9;
        border: 1px solid #e6dccb;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.15s, transform 0.15s;
    }

    .produk-pick-card:hover {
        box-shadow: 0 4px 12px rgba(74, 55, 40, 0.12);
        transform: translateY(-2px);
    }

    .produk-pick-photo-btn {
        border: none;
        padding: 0;
        background: none;
        cursor: pointer;
        display: block;
        width: 100%;
    }

    .produk-pick-photo {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        background-color: #f2ead9;
        display: block;
    }

    .produk-pick-body {
        padding: 8px 10px 10px;
    }

    .produk-pick-nama {
        color: #4a3728;
        font-weight: 600;
        font-size: 0.82rem;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .produk-pick-harga {
        color: #a67c52;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .produk-pick-add {
        display: flex;
        gap: 6px;
    }

    .produk-pick-add input[type="number"] {
        padding: 4px 6px;
        font-size: 0.8rem;
    }

    .produk-pick-add button {
        font-size: 0.8rem;
        white-space: nowrap;
    }
</style>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<h4 class="mb-3">Tambah dan Edit</h4>

<div class="row g-3">

    {{-- -------------------- PRODUK -------------------- --}}
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body" style="max-height:70vh; overflow:auto">

                <form method="GET" action="{{ route('penjualan.create') }}">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control mb-3"
                        placeholder="Cari produk..."
                        oninput="clearTimeout(window._st); window._st = setTimeout(() => this.form.submit(), 500)">
                </form>

                <div class="produk-grid">
                    @forelse($products as $product)
                    <div class="produk-pick-card">
                        <button type="button" class="produk-pick-photo-btn">
                            <img src="{{ asset('storage/'.$product->foto) }}"
                                alt="{{ $product->nama }}"
                                class="produk-pick-photo">
                        </button>

                        <div class="produk-pick-body">
                            <div class="produk-pick-nama" title="{{ $product->nama }}">{{ $product->nama }}</div>
                            <div class="produk-pick-harga">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</div>

                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="produk-pick-add">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="penjualan_id" value="{{ optional($sale)->id }}">

                                <input type="number" name="quantity" value="1" min="1"
                                    class="form-control {{ optional($sale)->status === 'COMPLETED' ? 'readonly' : '' }}"
                                    style="width:50px"
                                    {{ optional($sale)->status === 'COMPLETED' ? 'readonly' : '' }}>

                                <button type="submit" class="btn btn-primary flex-fill
                                    {{ optional($sale)->status === 'COMPLETED' ? 'disabled' : '' }}"
                                    {{ optional($sale)->status === 'COMPLETED' ? 'disabled' : '' }}>Beli</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted py-4">
                        Produk tidak ditemukan
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>{{-- END col-md-6 PRODUK --}}

    {{-- ==================== KERANJANG ==================== --}}
    <div class="col-md-6">
        <div class="card h-100 shadow-sm d-flex flex-column justify-content-between">
            <div class="table-responsive mb-0">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(optional($sale)->itempenjualan ?? [] as $item)
                        <tr>
                            <td>{{ optional($item->produk)->nama }}</td>
                            <td>Rp {{ number_format(optional($item->produk)->harga_jual ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity"
                                        value="{{ $item->kuantitas }}"
                                        min="1"
                                        class="form-control form-control-sm"
                                        {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}
                                        onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>
                                @if($sale->status !== 'COMPLETED')
                                    @can('delete', $item)
                                    <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    @endcan
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Keranjang masih kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer mt-auto">
                <div class="mb-2">
                    <strong>Total: Rp {{ number_format(optional($sale)->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                </div>

                {{-- Form Checkout --}}
                @if($sale)
                <form method="POST" action="{{ route('penjualan.update', $sale->id) }}"
                    onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                    @csrf @method('PUT')
                    <select name="metode_pembayaran" class="form-select mb-2"
                        {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH" {{ $sale->metode_pembayaran === 'CASH' ? 'selected' : '' }}>Cash</option>
                        <option value="QRIS" {{ $sale->metode_pembayaran === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    </select>
                    <button type="submit"
                        class="btn btn-success w-100"
                        {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                        Checkout
                    </button>
                </form>

                {{-- Form Batal Transaksi - hanya admin --}}
                @if($sale->status !== 'COMPLETED')
                    @can('delete', $sale)
                    <form method="POST" action="{{ route('penjualan.destroy', $sale->id) }}" class="mt-2">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100"
                            onclick="return confirm('Yakin ingin membatalkan transaksi ini?')">
                            Batal Transaksi
                        </button>
                    </form>
                    @endcan
                @endif
                @endif
            </div>
        </div>
    </div>

</div>

@endsection