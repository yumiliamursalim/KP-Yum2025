@extends('layout/aplikasi')

@section('konten')
<style>
    .cart-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
    }

    .cart-title {
        color: yellowgreen;
        text-align: center;
        margin-bottom: 20px;
    }

    .cart-alert {
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .cart-alert-success {
        background-color: #dff0d8;
        color: #3c763d;
    }

    .cart-alert-warning {
        background-color: #fcf8e3;
        color: #8a6d3b;
        text-align: center;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .cart-table th,
    .cart-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .cart-table th {
        background-color: yellowgreen;
        color: white;
    }

    .cart-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .cart-btn {
        display: inline-block;
        padding: 8px 14px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
    }

    .cart-btn-danger {
        background-color: crimson;
        color: white;
    }

    .cart-btn-checkout {
        background-color: yellowgreen;
        color: white;
        margin-top: 20px;
        float: right;
    }

    .cart-total-row {
        font-weight: bold;
        background-color: #f0f0f0;
        color: black
    }
    tbody{
        background-color: black;
        color: white
    }
</style>

<div class="cart-container">
    <h3 class="cart-title">Keranjang Belanja</h3>

    @if(session('success'))
        <div class="cart-alert cart-alert-success">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <div class="cart-alert cart-alert-warning">Keranjang kamu kosong.</div>
    @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($items as $item)
                    @php
                        $subtotal = $item->produk->harga * $item->jumlah;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td>Rp{{ number_format($item->produk->harga) }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp{{ number_format($subtotal) }}</td>
                        <td>
                            <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cart-btn cart-btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="cart-total-row">
                    <td colspan="3" style="text-align: right;">Total:</td>
                    <td colspan="2" style="text-align: left;">Rp{{ number_format($total) }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('checkout.form') }}" class="cart-btn cart-btn-checkout">Lanjut ke Checkout</a>
    @endif
</div>
@endsection
