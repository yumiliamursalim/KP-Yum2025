@extends('layout.aplikasi')

@section('konten')
<style>
    .order-container {
    max-width: 700px;
    margin: 30px auto;
    padding: 10px;
}

.order-title {
    text-align: center;
    margin-bottom: 25px;
    color: yellowgreen;
}

.order-empty {
    text-align: center;
    font-style: italic;
    color: #777;
}

.order-card {
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-bottom: 25px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}

.order-header {
    background-color: #414141;
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.order-body {
    padding: 15px;
}

.order-list {
    list-style: none;
    padding: 0;
    margin-bottom: 10px;
}

.order-item,
.order-total {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.order-total {
    font-weight: bold;
    color: #333;
    border-top: 1px solid #ddd;
}

.order-info {
    margin-top: 10px;
    color: #444;
}

</style>
<div class="order-container">
    <h2 class="order-title">Pesanan Saya</h2>

    @if($pesanan->isEmpty())
        <p class="order-empty">Kamu belum memiliki pesanan.</p>
    @else
        @foreach($pesanan as $p)
        <div class="order-card">
            <div class="order-header">
                <p><strong>ID Pesanan:</strong> {{ $p->id }}</p>
                <p><strong>Status:</strong> {{ ucfirst($p->status) }}</p>
                <p><strong>Tanggal:</strong> {{ $p->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="order-body">
                <ul class="order-list">
                    @foreach($p->detailPesanan as $item)
                    <li class="order-item">
                        <span>{{ $item->produk->nama }} x {{ $item->jumlah }}</span>
                        <span>Rp{{ number_format($item->produk->harga * $item->jumlah) }}</span>
                    </li>
                    @endforeach
                    <li class="order-total">
                        <strong>Total</strong>
                        <strong>Rp{{ number_format($p->total_harga) }}</strong>
                    </li>
                </ul>
                <p class="order-info"><strong>Alamat Pengiriman:</strong> {{ $p->alamat_pengiriman }}</p>
                <p class="order-info"><strong>Metode Pembayaran:</strong> {{ $p->metode_pembayaran }}</p>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
