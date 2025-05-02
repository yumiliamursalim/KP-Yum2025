@extends('layout/aplikasi')

@section('konten')
<form method="POST" action="/siswa" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="nomor_induk" class="form-label">Nomor Induk</label>
      <input type="text" class="form-control" name="nomor_induk" id="nomor_induk" value="{{Session::get('nomor_induk')}}">
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" name="nama" id="nama" value="{{Session::get('nama')}}">
    </div>
    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="" cols="30" rows="10" name="alamat">{{Session::get('alamat')}}</textarea>
    </div>
    <div class="mb-3">
      <label for="foto" class="form-label">Foto</label>
      <input type="file" class="form-control" id="foto" name="foto">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection