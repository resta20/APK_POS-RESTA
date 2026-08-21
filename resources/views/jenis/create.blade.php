@extends('layouts.app')

@section('content')
<style>
    .jenis-form-page {
        font-family: 'Work Sans', sans-serif;
        padding: 24px 0;
    }

    .jenis-form-page h2 {
        font-weight: 700;
        color: #4a3728;
        font-size: 1.4rem;
        margin-bottom: 20px;
    }

    .jenis-form-page label {
        color: #4a3728;
        font-weight: 500;
        margin-bottom: 6px;
    }

    .jenis-form-page .form-control {
        border: 1px solid #e6dccb;
    }

    .btn-simpan {
        background: #a67c52;
        border: none;
        color: #fffdf9;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 4px;
    }

    .btn-simpan:hover {
        background: #8f6842;
        color: #fffdf9;
    }

    .btn-batal {
        background: transparent;
        border: 1px solid #e6dccb;
        color: #4a3728;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 4px;
    }

    .btn-batal:hover {
        background: #f5f1e8;
        color: #4a3728;
    }
</style>

<div class="container jenis-form-page" style="max-width: 500px;">
    <h2>Tambah Jenis</h2>

    <form action="{{ route('jenis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Jenis</label>
            <input type="text" name="nama_jenis" value="{{ old('nama_jenis') }}" class="form-control @error('nama_jenis') is-invalid @enderror">
            @error('nama_jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-simpan">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-batal">Batal</a>
    </form>
</div>
@endsection