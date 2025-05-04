@extends('layout.aplikasi')

@section('konten')
<div class="container">
    <h3>Pesanan Saya</h3>

    @if($pesanan->isEmpty())
        <p>Kamu belum memiliki pesanan.</p>
    @else
        @foreach($pesanan as $p)
        <div class="card mb-3">
            <div class="card-header">
                <strong>ID Pesanan:</strong> {{ $p->id }} <br>
                <strong>Status:</strong> {{ ucfirst($p->status) }} <br>
                <strong>Tanggal:</strong> {{ $p->created_at->format('d M Y H:i') }}
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($p->detailPesanan as $item)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>{{ $item->produk->nama }} x {{ $item->jumlah }}</div>
                        <div>Rp{{ number_format($item->produk->harga * $item->jumlah) }}</div>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>Rp{{ number_format($p->total_harga) }}</strong>
                    </li>
                </ul>
                <p class="mt-3"><strong>Alamat Pengiriman:</strong> {{ $p->alamat_pengiriman }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $p->metode_pembayaran }}</p>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
