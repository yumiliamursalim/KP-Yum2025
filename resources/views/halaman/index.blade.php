@extends('layout/aplikasi')  

@section('konten')

@include('komponen.slider')
@include('komponen.kategori')
@include('komponen.loginfo')

<!-- produk  -->
<div class="small-container">
  <h2 class="title">Produk Terbaru</h2>
  <div class="row">
      @foreach ($produkTerbaru as $produk)
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
      @endforeach
  </div>
</div>
@endsection