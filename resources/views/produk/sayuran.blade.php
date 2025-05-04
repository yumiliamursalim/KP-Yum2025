@extends('layout.aplikasi')

@section('konten')
    
<style>
    /* Wrapper untuk filter search */
    .form-filter-wrapper {
        display: flex;
        gap: 10px;
        margin: 20px 0;
        align-items: center;
    }

    .form-filter-wrapper input[type="text"],
    .form-filter-wrapper select,
    .form-filter-wrapper button {
        height: 36px;
        padding: 0 12px;
        border-radius: 6px;
        border: 1px solid yellowgreen;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form-filter-wrapper select{
    }

    .form-filter-wrapper input[type="text"],
    .form-filter-wrapper select {
        width: 180px;
        background-color: #fdfdfd;
        color: #333;
    }

    .form-filter-wrapper button {
        background-color: yellowgreen;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s ease;
        border: none;
    }

    .form-filter-wrapper button:hover {
        background-color: #d9d9d9;
        color: black
    }
</style>
<div class="small-container">
    <h2 class="title">Produk Sayuran</h2>
{{-- Form Pencarian & Sort --}}
    <form method="GET" action="{{ route('produk.kategori.sayur') }}" class="form-filter-wrapper">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk...">
        <button type="submit">Cari</button>
        <div style="width: 800%" class="kos"></div>
        <select name="sort" onchange="this.form.submit()">
            <option value="">Urutkan</option>
            <option value="termurah" {{ request('sort') === 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
            <option value="termahal" {{ request('sort') === 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
        </select>
    </form>

    <div class="row">
        @forelse ($produkTerbaru as $produk)
        <div class="col-4">
            <a href="{{ route('produk.show', $produk->id) }}">
                @if ($produk->foto)
                    <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="{{ $produk->nama }}" style="width:100%; aspect-ratio:1/1; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/250x250?text=Tidak+ada+Foto" alt="Tidak ada foto" style="width:100%; aspect-ratio:1/1; object-fit:cover;">
                @endif
            </a>
            <h4>{{ $produk->nama }}</h4>
            <p>Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
        </div>
        @empty
        <p>Tidak ada produk ditemukan.</p>
        @endforelse
    </div>
    
    {{-- PAGINATION --}}
    <div style="margin-top: 20px;">
        {{ $produkTerbaru->withQueryString()->links() }}
    </div>
    
</div>
@endsection
