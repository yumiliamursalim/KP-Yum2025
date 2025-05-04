@extends('layout/aplikasi')

@section('konten')
<style>
    .small-container{
        color: white;
    };
    
</style>
<div class="small-container single-product mt-4">
    <div class="row">
        <div class="col-4">
            <section>
                <div id="">
                    <div id="slidingImage">
                        @if($produk->foto)
                            <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="{{ $produk->nama }}" style="max-height: 300px;">
                        @else
                            <p>Foto tidak tersedia</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>

        <div class="col-6">
            <p><a href="#">Kategori</a> / {{ ucfirst($produk->kategori) }}</p>
            <h2>{{ $produk->nama }}</h2>
            <h4>Rp {{ number_format($produk->harga, 0, ',', '.') }}</h4>

            <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST">
                @csrf
                <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" class="form-control w-25 mb-3" />
                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
            </form>
            

            <h3 class="mt-4">Detail Produk</h3>
            <hr>
            <p>{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

            <p><strong>Stok tersedia:</strong> {{ $produk->stok }}</p>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
<br>
<br>
<div class="small-container">
    <div class="row-2 row" style="color: greenyellow; justify-content: space-between;">
      <h2>Rekomendasi {{ ucfirst($produk->kategori) }}</h2>
      <a href="/sayuran">
        <p style="color: greenyellow;">More</p>
      </a>
    </div>
<div class="row">
    @foreach ($produkRekomendasi as $produk)
      <div class="col-4">
          <a href="{{ route('produk.show', $produk->id) }}">
              @if ($produk->foto)
                  <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="{{ $produk->nama }}" style="width:100%; aspect-ratio: 1/1; object-fit:cover;">
              @else
                  <img src="https://via.placeholder.com/250x250?text=Tidak+ada+Foto" alt="Tidak ada foto">
              @endif
          </a>
          <h4>{{ $produk->nama }}</h4>
          <p>Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
      </div>
      @endforeach
</div>
</div>

@endsection
