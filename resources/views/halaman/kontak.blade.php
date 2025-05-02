@extends('layout.aplikasi')  

@section('konten')

{{-- Tambahkan link ke Font Awesome --}}

<style>
    .kontak-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        background-color: #1c1c1c;
        color: white;
        text-align: center;
        padding: 40px 20px;
    }

    .kontak-container h1 {
        font-size: 40px;
        color: yellowgreen;
        margin-bottom: 10px;
    }

    .kontak-container p {
        max-width: 600px;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .kontak-container a.contact-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        font-size: 18px;
        background-color: transparent;
        color: yellowgreen;
        border: 2px solid yellowgreen;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .kontak-container a.contact-link:hover {
        background-color: rgb(255, 255, 255);
        color: #1c1c1c;
    }

    .contact-link i {
        font-size: 20px;
    }

    

</style>

<div class="kontak-container">
    <h1>CONTACT</h1>
    <a href="/" style="text-decoration: none;">
      <img src="{{asset("foto/asset/logoluk.png")}}" alt="" width="100px">
    </a>
    <br>
    <p>
        Kamu akan menemukan berbagai informasi seputar LukyFresh di halaman ini. Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami secara langsung.
    </p>
    <div class="hov">
      <a href="https://wa.me/6288224441157" target="_blank" class="contact-link">
          <img width="20px" src="{{ asset('foto/asset/whatsapp.svg') }}" alt=""> Hubungi via WhatsApp
      </a>
    </div>
</div>

@endsection


git add .
git commit -m "commit pertama"

