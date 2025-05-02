@extends('layout.aplikasi')

@section('konten')
<div class="small-container">
    <h2 class="title">Semua Produk</h2>

    {{-- Form Pencarian & Sort --}}
    <form method="GET" action="{{ route('produk.semua') }}" class="mb-4 d-flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="form-control" style="max-width: 250px;">
        <select name="sort" onchange="this.form.submit()" class="form-select" style="max-width: 150px;">
            <option value="">Sortir</option>
            <option value="termurah" {{ request('sort') === 'termurah' ? 'selected' : '' }}>Termurah</option>
            <option value="termahal" {{ request('sort') === 'termahal' ? 'selected' : '' }}>Termahal</option>
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <div class="row">
        @forelse ($produkTerbaru as $produk)
        <div class="col-4">
            <a href="{{ route('produk.show', $produk->id) }}">
                @if ($produk->foto)
                    <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="{{ $produk->nama }}" style="width:100%; height:250px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/250x250?text=Tidak+ada+Foto" alt="Tidak ada foto">
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
