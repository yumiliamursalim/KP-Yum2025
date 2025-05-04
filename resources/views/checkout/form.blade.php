@extends('layout/aplikasi')

@section('konten')
<style>
    .checkout-container {
    max-width: 600px;
    margin: 30px auto;
    padding: 25px;
    border: 1px solid #ccc;
    border-radius: 12px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.checkout-title {
    text-align: center;
    color: yellowgreen;
    margin-bottom: 25px;
}

.checkout-alert {
    background-color: #f8d7da;
    color: #721c24;
    padding: 12px;
    border: 1px solid #f5c6cb;
    border-radius: 6px;
    margin-bottom: 20px;
}

.checkout-form .form-group {
    margin-bottom: 18px;
}

.input-textarea,
.input-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #bbb;
    border-radius: 6px;
    font-size: 14px;
    margin-top: 5px;
}

.checkout-subtitle {
    margin-top: 30px;
    margin-bottom: 10px;
    color: #333;
    font-weight: 600;
}

.summary-list {
    list-style: none;
    padding: 0;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

.summary-item,
.summary-total {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.summary-total {
    font-weight: bold;
    color: #333;
}

.checkout-button {
    background-color: yellowgreen;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    margin-top: 20px;
    width: 100%;
}

.checkout-button:hover {
    background-color: #86b300;
}

</style>
<div class="checkout-container">
    <h2 class="checkout-title">Form Checkout</h2>

    @if(session('error'))
        <div class="checkout-alert">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.proses') }}" method="POST" class="checkout-form">
        @csrf

        <div class="form-group">
            <label for="alamat_pengiriman">Alamat Pengiriman</label>
            <textarea id="alamat_pengiriman" name="alamat_pengiriman" class="input-textarea" required></textarea>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select id="metode_pembayaran" name="metode_pembayaran" class="input-select" required>
                <option value="">Pilih Metode</option>
                <option value="COD">COD (Bayar di Tempat)</option>
                <option value="Transfer">Transfer Bank</option>
            </select>
        </div>

        <h4 class="checkout-subtitle">Ringkasan Pesanan</h4>
        <ul class="summary-list">
            @php $total = 0; @endphp
            @foreach($keranjang as $item)
                @php $subtotal = $item->produk->harga * $item->jumlah; $total += $subtotal; @endphp
                <li class="summary-item">
                    <span>{{ $item->produk->nama }} x {{ $item->jumlah }}</span>
                    <span>Rp{{ number_format($subtotal) }}</span>
                </li>
            @endforeach
            <li class="summary-total">
                <strong>Total</strong>
                <strong>Rp{{ number_format($total) }}</strong>
            </li>
        </ul>

        <button type="submit" class="checkout-button">Checkout Sekarang</button>
    </form>
</div>
@endsection
