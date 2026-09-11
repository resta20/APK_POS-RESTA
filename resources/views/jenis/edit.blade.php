@extends('layouts.app')

@section('content')
<style>
    .jenis-form-page {
        font-family: 'Work Sans', sans-serif;
        padding: 24px 0;
    }

    .jenis-form-page h2 {
        font-weight: 700;
        color: #4a3f35;
        font-size: 1.4rem;
        margin-bottom: 20px;
    }

    .jenis-form-page label {
        color: #4a3f35;
        font-weight: 500;
        margin-bottom: 6px;
    }

    .jenis-form-page .form-control {
        border: 1px solid #f0d6d6;
    }

    .btn-simpan {
        background: #e29aa4;
        border: none;
        color: #fdf8f0;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 4px;
    }

    .btn-simpan:hover {
        background: #d17d8c;
        color: #fdf8f0;
    }

    .btn-batal {
        background: transparent;
        border: 1px solid #f0d6d6;
        color: #4a3f35;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 4px;
    }

    .btn-batal:hover {
        background: #fdf8f0;
        color: #4a3f35;
    }
</style>

<div class="container jenis-form-page" style="max-width: 500px;">
    <h2>Edit Jenis</h2>

    <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Jenis</label>
            <input type="text" name="nama_jenis" value="{{ old('nama_jenis', $jenis->nama_jenis) }}" class="form-control @error('nama_jenis') is-invalid @enderror">
            @error('nama_jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-simpan">Update</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-batal">Batal</a>
    </form>
</div>
@endsection