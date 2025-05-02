@extends('layout.aplikasi')

@section('konten')

<style>
  .about-container {
    text-align: center;
    padding: 40px 20px;
    background-color: #121212; /* gelap */
    color: white;
}

.about-logo {
    max-width: 150px;
    margin-bottom: 20px;
}

.about-title {
    color: yellowgreen;
    font-size: 36px;
    margin-bottom: 10px;
}

.about-desc {
    font-size: 18px;
    max-width: 800px;
    margin: 0 auto 40px;
    line-height: 1.6;
}

.about-columns {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px;
}

.about-col {
    flex: 1 1 300px;
    max-width: 500px;
    background-color: #1b1b1b;
    padding: 20px;
    border-radius: 10px;
    text-align: left;
}

.about-col h3 {
    color: yellowgreen;
    margin-bottom: 10px;
}

.about-col p {
    font-size: 16px;
    line-height: 1.6;
}

</style>

<div class="about-container">
    <img src="{{ asset('foto/asset/LUKYFRESHlogocir.png') }}" alt="Logo LukyFresh" class="about-logo">
    <p class="about-desc">
        LukyFresh adalah solusi belanja sayur dan buah segar secara online yang cepat, mudah, dan langsung dari petani ke tangan konsumen. Dengan antarmuka yang responsif dan modern, LukyFresh hadir untuk mendukung pola hidup sehat masyarakat Indonesia.
    </p>

    <div class="about-columns">
        <div class="about-col">
            <h3>Kenapa Pilih LukyFresh?</h3>
            <p>
                Kami bekerja sama langsung dengan petani lokal untuk memastikan produk yang dijual adalah hasil panen segar, tanpa perantara. Pengiriman cepat dan kualitas terjamin adalah prioritas utama kami.
            </p>
        </div>
        <div class="about-col">
            <h3>Komitmen Kami</h3>
            <p>
                LukyFresh berkomitmen mendukung gaya hidup sehat dengan menyediakan produk alami berkualitas tinggi. Kami juga mengedepankan keberlanjutan dan mendukung ekonomi lokal dengan memberdayakan petani kecil.
            </p>
        </div>
    </div>
</div>


@endsection
