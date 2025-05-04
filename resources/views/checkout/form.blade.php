@extends('layout/aplikasi')

@section('konten')
<div class="container">
    <h3>Form Checkout</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.proses') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control" required>
                <option value="">Pilih Metode</option>
                <option value="COD">COD (Bayar di Tempat)</option>
                <option value="Transfer">Transfer Bank</option>
            </select>
        </div>

        <h5>Ringkasan Pesanan:</h5>
        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($keranjang as $item)
                @php $subtotal = $item->produk->harga * $item->jumlah; $total += $subtotal; @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item->produk->nama }} x {{ $item->jumlah }}
                    <span>Rp{{ number_format($subtotal) }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total</strong>
                <strong>Rp{{ number_format($total) }}</strong>
            </li>
        </ul>

        <button type="submit" class="btn btn-primary">Checkout Sekarang</button>
    </form>
</div>
@endsection
