@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('penjualan-body')

    <style>
        .struk-wrapper {
            display: flex;
            justify-content: center;
        }

        .struk {
            font-family: 'Courier New', Courier, monospace;
            width: 100%;
            max-width: 380px;
            background-color: #fffdfa;
            border: 1px solid #f0d6d6;
            border-radius: 10px;
            padding: 1.5rem 1.5rem 1.25rem;
            color: #4a3f35;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .struk-header {
            text-align: center;
            margin-bottom: 0.75rem;
        }
        .struk-header h5 {
            font-family: 'Fredoka', sans-serif;
            font-weight: 700;
            margin-bottom: 0.1rem;
            color: #4a3f35;
        }
        .struk-header small {
            color: #a8887f;
            letter-spacing: 0.05em;
        }

        .struk-divider {
            border-top: 1px dashed #d8b8b8;
            margin: 0.75rem 0;
        }

        .struk-info div {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 0.35rem;
        }
        .struk-info .label {
            color: #a8887f;
        }
        .struk-info .value {
            font-weight: 600;
            text-align: right;
        }

        .badge-status {
            display: inline-block;
            padding: 0.15rem 0.6rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.72rem;
        }
        .badge-completed { background-color: #e8f0e3; color: #5f7a52; }
        .badge-open { background-color: #fbeed9; color: #a3792f; }

        .struk-item {
            margin-bottom: 0.6rem;
            font-size: 0.85rem;
        }
        .struk-item .produk-nama {
            font-weight: 600;
            margin-bottom: 0.15rem;
        }
        .struk-item .produk-rincian {
            display: flex;
            justify-content: space-between;
            color: #7a6a60;
        }

        .struk-total {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.5rem;
        }

        .struk-footer {
            text-align: center;
            margin-top: 1rem;
            color: #a8887f;
            font-size: 0.8rem;
        }

        .struk-empty {
            text-align: center;
            color: #a8887f;
            font-size: 0.85rem;
            padding: 0.5rem 0;
        }
    </style>

    <div class="struk-wrapper">
        <div class="struk">

            <div class="struk-header">
                <h5>restathrift</h5>
                <small>STRUK PENJUALAN</small>
            </div>

            <div class="struk-divider"></div>

            <div class="struk-info">
                <div>
                    <span class="label">Tanggal</span>
                    <span class="value">{{ $penjualan->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
                </div>
                <div>
                    <span class="label">Kasir</span>
                    <span class="value">{{ $penjualan->user->name }}</span>
                </div>
                <div>
                    <span class="label">Metode</span>
                    <span class="value">{{ $penjualan->metode_pembayaran }}</span>
                </div>
                <div>
                    <span class="label">Status</span>
                    <span class="value">
                        <span class="badge-status {{ $penjualan->status === 'COMPLETED' ? 'badge-completed' : 'badge-open' }}">
                            {{ $penjualan->status }}
                        </span>
                    </span>
                </div>

                @if ($penjualan->metode_pembayaran === 'CASH' && !is_null($penjualan->uang_diterima))
                    <div>
                        <span class="label">Uang Diterima</span>
                        <span class="value">Rp {{ number_format($penjualan->uang_diterima, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="label">Kembalian</span>
                        <span class="value">Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>

            <div class="struk-divider"></div>

            @forelse($penjualan->itempenjualan as $item)
                <div class="struk-item">
                    <div class="produk-nama">{{ $item->produk->nama ?? '-' }}</div>
                    <div class="produk-rincian">
                        <span>{{ $item->kuantitas }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            @empty
                <div class="struk-empty">Tidak ada item</div>
            @endforelse

            <div class="struk-divider"></div>

            <div class="struk-total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
            </div>

            <div class="struk-footer">
                Terima kasih telah berbelanja!
            </div>

        </div>
    </div>

@endsection

@section('content')

    <h1 class="mb-3" style="color:#4a3f35; font-weight:700;">Detail Penjualan</h1>

    @yield('penjualan-body')

    <div class="struk-wrapper">
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary mt-3" style="border:1px solid #f0d6d6; color:#4a3f35;">
            Kembali
        </a>
    </div>

@endsection