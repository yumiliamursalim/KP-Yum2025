@extends('layout/aplikasi')

@section('konten')
<style>
    .container{
        color: white
    }
</style>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Edit Produk</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach(['sayur', 'buah', 'rempah'] as $kategori)
                            <option value="{{ $kategori }}" {{ $produk->kategori == $kategori ? 'selected' : '' }}>{{ ucfirst($kategori) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $produk->stok) }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label><br>
                    @if ($produk->foto)
                        <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="foto" class="img-thumbnail mb-2" style="width: 100%; height: 100px; max-width: 100px; object-fit:cover;">
                    @endif
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
