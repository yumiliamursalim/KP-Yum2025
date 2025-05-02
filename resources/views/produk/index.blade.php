@extends('layout/aplikasi')

@section('konten')
<style>
    .container{
        color: white
    }
</style>

<div class="container">
    <h1 class="mb-4">Daftar Produk</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    @if ($produk->isEmpty())
        <div class="alert alert-info">
            Belum ada produk yang ditambahkan.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $index => $produk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($produk->foto)
                                    <img src="{{ asset('foto_produk/' . $produk->foto) }}" alt="Foto Produk" style="width: 100%; height: 50px; max-width: 60px; object-fit:cover;">

                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ ucfirst($produk->kategori) }}</td>
                            <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
