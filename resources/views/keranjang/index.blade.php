@extends('layout/aplikasi')

@section('konten')
<div class="container">
    <h3>Keranjang Belanja</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <p>Keranjang kamu kosong.</p>
    @else
        <table class="table">
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
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td>Rp{{ number_format($item->produk->harga) }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp{{ number_format($item->produk->harga * $item->jumlah) }}</td>
                    <td>
                        <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('checkout.form') }}" class="btn btn-success">Lanjut ke Checkout</a>
    @endif
</div>
@endsection
