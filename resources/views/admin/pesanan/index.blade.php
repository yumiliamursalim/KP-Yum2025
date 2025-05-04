@extends('layout.aplikasi')

@section('konten')
<style>
    body {
        color: #ffffff;
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    h3 {
        margin-bottom: 1.5rem;
        color: #fff;
    }

    .card {
        background-color: #1e1e1e;
        border: 1px solid #333;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.4);
    }

    .card-header {
        border-bottom: 1px solid #333;
        padding: 16px;
        background-color: #252525;
        border-radius: 10px 10px 0 0;
    }

    .info-bar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        row-gap: 10px;
        color: #ffffff;
    }

    .info-bar div {
        font-size: 14px;
    }

    .info-bar span {
        font-weight: bold;
        color: #ffffff;
    }

    .card-body {
        padding: 16px;
    }

    .list-group {
        list-style: none;
        padding: 0;
        margin: 0 0 16px 0;
    }

    .list-group-item {
        padding: 10px 16px;
        border-bottom: 1px solid #333;
        display: flex;
        justify-content: space-between;
    }

    .list-group-item:last-child {
        border-bottom: none;
        background-color: #2a2a2a;
        font-weight: bold;
        color: #fff;
    }

    p {
        margin-bottom: 10px;
    }

    .form-select {
        padding: 6px 10px;
        background-color: #2c2c2c;
        color: #eee;
        border: 1px solid #555;
        border-radius: 5px;
    }

    .btn {
        padding: 6px 12px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .gap-2 {
        gap: 8px;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .w-auto {
        width: auto;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .badge {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        text-transform: capitalize;
        font-weight: 600;
    }

    .bg-warning { background-color: #ffc107; color: #000; }
    .bg-danger { background-color: #dc3545; color: #fff; }
    .bg-info { background-color: #17a2b8; color: #fff; }
    .bg-success { background-color: #28a745; color: #ffffff; }

    .form-filter-wrapper {
    display: flex;
    gap: 10px;
    margin: 20px 0;
    align-items: center;
}

.form-filter-wrapper input[type="text"],
.form-filter-wrapper select,
.form-filter-wrapper button {
    height: 36px;
    padding: 0 12px;
    border-radius: 6px;
    border: 1px solid yellowgreen;
    font-size: 14px;
    box-sizing: border-box;
}

.form-filter-wrapper input[type="text"],
.form-filter-wrapper select {
    width: 180px;
    background-color: #fdfdfd;
    color: #333;
}

.form-filter-wrapper button {
    background-color: yellowgreen;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border: none;
}

.form-filter-wrapper button:hover {
    background-color: #d9d9d9;
    color: black;
}


</style>

<div class="container">
    <h3>Daftar Semua Pesanan</h3>

    <form method="GET" action="{{ route('admin.pesanan.index') }}" class="form-filter-wrapper">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan...">
        <button type="submit">Cari</button>
        <div style="width: 800%" class="kos"></div>
        <select name="status" onchange="this.form.submit()">
            <option value="">Filter Status</option>
            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </form>
    
    
    @foreach($pesanan as $p)
    <div class="card mb-3">
        <div class="card-header">
            <div class="info-bar">
                <div><span>ID:</span> #{{ $p->id }}</div>
                <div><span>Pelanggan:</span> {{ $p->user->name }}</div>
                <div><span>Status:</span> <span class="badge {{ $p->status == 'diproses' ? 'bg-warning' : ($p->status == 'ditolak' ? 'bg-danger' : ($p->status == 'dikirim' ? 'bg-info' : 'bg-success')) }}">{{ ucfirst($p->status) }}</span></div>
                <div><span>Tanggal:</span> {{ $p->created_at->format('d M Y H:i') }}</div>
            </div>
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
