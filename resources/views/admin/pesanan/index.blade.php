@extends('layout.aplikasi')

@section('konten')
<div class="container">
    <h3>Daftar Semua Pesanan</h3>

    @foreach($pesanan as $p)
    <div class="card mb-3">
        <div class="card-header">
            <strong>ID:</strong> {{ $p->id }} | 
            <strong>Pelanggan:</strong> {{ $p->user->name }} | 
            <strong>Status:</strong> {{ ucfirst($p->status) }} | 
            <strong>Tanggal:</strong> {{ $p->created_at->format('d M Y H:i') }}
        </div>
        <div class="card-body">
            <ul class="list-group mb-3">
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
            <p><strong>Alamat:</strong> {{ $p->alamat_pengiriman }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $p->metode_pembayaran }}</p>

            <form action="{{ route('admin.pesanan.ubah-status', $p->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                @csrf
                <select name="status" class="form-select w-auto">
                    <option value="diproses" {{ $p->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="ditolak" {{ $p->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="dikirim" {{ $p->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $p->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
