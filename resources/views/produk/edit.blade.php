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
        flex-wrap: wrap;
        gap: 1rem;
        cursor: pointer;
    }


    .btn-success {
        background-color: yellowgreen;
        border: none;
        color: #111;
        padding: 0.6rem 1.2rem;
        font-weight: bold;
        border-radius: 6px;
    }

    .btn-secondary {
        background-color: #555;
        border: none;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
    }

    .img-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 2px solid yellowgreen;
        border-radius: 6px;
        margin-bottom: 10px;
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
    
    .btn-success {
    background-color: yellowgreen;
    border: none;
    color: #111;
    padding: 0.6rem 1.2rem;
    font-weight: bold;
    border-radius: 6px;
}
.btn-success:hover {
    color: #ffff;
    box-shadow: 0 5px 10px 5px #ff945680, 5px 10px 30px 0 yellowgreen;
    transition: 0.2s ease-in;
    cursor: pointer;
}

.btn-secondary {
    background-color: #555;
    border: none;
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 6px;
}
.btn-secondary:hover {
    color: #ffff;
    box-shadow: 0 5px 10px 5px #ff945680, 5px 10px 30px 0 yellowgreen;
    transition: 0.2s ease-in;
    cursor: pointer;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 6px;
}
.btn-danger:hover {
    color: #ffff;
    box-shadow: 0 5px 10px 5px #ff945680, 5px 10px 30px 0 yellowgreen;
    transition: 0.2s ease-in;
    cursor: pointer;
}

</style>

<div class="produk-form-wrapper">
    <h1 class="produk-form-title">Edit Produk</h1>

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

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="produk-form-grid">
            <!-- Kolom Kiri -->
            <div>
                <div class="produk-form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}" required>
                </div>
                <div class="produk-form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(['sayur', 'buah', 'rempah'] as $kategori)
                            <option value="{{ $kategori }}" {{ $produk->kategori == $kategori ? 'selected' : '' }}>{{ ucfirst($kategori) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="produk-form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" required>
                </div>
                <div class="produk-form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div>
                <div class="produk-form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="7">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div class="produk-form-group">
                    <label for="foto">Foto Produk</label>
                    @if ($produk->foto)
                        <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="foto" class="img-preview">
                    @endif
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>
            </div>
        </div>

        <div class="produk-form-actions">
            <button type="submit" class="btn-success">Simpan Perubahan</button>

            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini?')" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Hapus</button>
            </form>

            <a href="{{ route('produk.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
