@extends('layout/aplikasi')

@section('konten')
<form method="POST" action="{{'/siswa/'.$data->nomor_induk}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="nomor_induk" class="form-label">Nomor Induk</label>
      <input type="text" class="form-control" name="nomor_induk" id="nomor_induk" value="{{$data->nomor_induk}}" readonly>
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" name="nama" id="nama" value="{{$data->nama}}">
    </div>
    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="" cols="30" rows="10" name="alamat">{{$data->alamat}}</textarea>
    </div>

    @if ($data->foto)
    <div class="bm-3">
      <img style="max-width: 50px;max-height: 50px" src="{{url('foto').'/'.$data->foto}}" alt="">
    </div>
      
    @endif
    <div class="mb-3">
      <label for="foto" class="form-label">Foto</label>
      <input type="file" class="form-control" id="foto" name="foto">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection