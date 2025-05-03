@extends('layout/aplikasi')

@section('konten')
<style>
    .produk-form-wrapper {
        max-width: 1000px;
        margin: 3rem auto;
        padding: 2rem;
        background-color: #1e1e1e;
        border-radius: 12px;
        color: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }

    .produk-form-title {
        margin-bottom: 2rem;
        font-size: 1.8rem;
        font-weight: bold;
        color: yellowgreen;
    }

    .produk-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .produk-form-group {
        margin-bottom: 1.2rem;
    }

    .produk-form-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .produk-form-group input,
    .produk-form-group select,
    .produk-form-group textarea {
        width: 100%;
        padding: 0.75rem;
        background-color: #2b2b2b;
        border: 1px solid #444;
        border-radius: 8px;
        color: white;
    }

    .produk-form-group input:focus,
    .produk-form-group select:focus,
    .produk-form-group textarea:focus {
        border-color: yellowgreen;
        outline: none;
    }

    .produk-form-actions {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
    }

    .produk-form-actions .btn-success {
        background-color: yellowgreen;
        border: none;
        color: #111;
        padding: 0.6rem 1.2rem;
        font-weight: bold;
        border-radius: 6px;
    }

    .produk-form-actions .btn-secondary {
        background-color: #555;
        width: auto;
        border: none;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        text-align: center
    }

    .produk-alert {
        margin-bottom: 1.5rem;
        background-color: #5a1e1e;
        padding: 1rem;
        border-radius: 8px;
        color: #f8d7da;
        border: 1px solid #a94442;
    }

    @media (max-width: 768px) {
        .produk-form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="produk-form-wrapper">
    <h2 class="produk-form-title">Tambah Produk</h2>

    @if ($errors->any())
        <div class="produk-alert">
            <strong>Ups!</strong> Ada beberapa masalah dengan input kamu:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="produk-form-grid">
            <!-- Kolom Kiri -->
            <div>
                <div class="produk-form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="produk-form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="sayur" {{ old('kategori') == 'sayur' ? 'selected' : '' }}>Sayur</option>
                        <option value="buah" {{ old('kategori') == 'buah' ? 'selected' : '' }}>Buah</option>
                        <option value="rempah" {{ old('kategori') == 'rempah' ? 'selected' : '' }}>Rempah</option>
                    </select>
                </div>

                <div class="produk-form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}" required>
                </div>

                <div class="produk-form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok') }}" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div>
                <div class="produk-form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="7">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="produk-form-group">
                    <label for="foto">Foto Produk</label>
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>
            </div>
        </div>

        <div class="produk-form-actions">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
