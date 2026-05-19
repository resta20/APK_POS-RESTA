@csrf

@if (!empty($produk->foto))
<div class="mb-2">
    <label>Foto saat ini</label><br>
    <img src="{{ asset('storage/' . $produk->foto) }}"
    width="150"
    class="img-thumbnail">  {{-- typo: img-thumbnaill → img-thumbnail --}}
</div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label>Gambar</label>
        <input type="file"
            name="foto"
            onchange="previewImage(this)"
            class="form-control @error('foto') is-invalid @enderror">  {{-- typo: is-invallid → is-invalid --}}
        @error('foto')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-6">
        <label>Preview Foto</label><br>
        <img id="preview" class="img-thumbnail mt-2" style="display:none" width="150">
    </div>

    <div class="col-12">  {{-- tambah col-12 agar full width dan keluar dari row gambar --}}
        <label>Nama Produk</label>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $produk->nama ?? '') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label>Harga Beli</label>
        <input type="number" name="purchase_price"
               class="form-control @error('purchase_price') is-invalid @enderror"
               value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
        @error('purchase_price')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label>Harga Jual</label>
        <input type="number" name="selling_price"
               class="form-control @error('selling_price') is-invalid @enderror"
               value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
        @error('selling_price')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label>Stok</label>
        <input type="number" name="stok"
               class="form-control @error('stok') is-invalid @enderror"
               value="{{ old('stok', $produk->stok ?? '') }}">
        @error('stok')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- tombol sejajar dengan d-flex --}}
    <div class="col-12 d-flex gap-2">
        <button class="btn btn-success mt-3" type="submit">Simpan</button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];  // bug: files(0) → files[0]

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>