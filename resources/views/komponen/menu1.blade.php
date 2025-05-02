<!-- header navbar -->
<div class="header">
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <img src="{{asset("foto/asset/logoluk.png")}}" alt="" width="200px">
          {{-- <h1><a href="/">LukyFresh</a></h1> --}}
        </div>

        <nav>
          <ul id="MenuItems">
            <li><a href="/">Beranda</a></li>
            <li><a href="{{ route('produk.semua') }}">Produk</a></li>
            <li><a href="/tentang">Tentang Kami</a></li>
            <li><a href="/kontak">Kontak</a></li>
            <li><a href="/sesi">Akun</a></li>
          </ul>
        </nav>

        <a class="cartt" href="cart.html">
          <img src="foto/asset/cart.png" alt="" width="30px" height="30px"/>
        </a>
          <img
            src="foto/menu.png"
            alt=""
            class="menu-icon"
            onclick="menutoggle()"
          />
      </div>
          
    </div>
  </div>
  
<!-- announcement -->
  <div class="announcement">
    <p>Dapatkan <span style="font-style: oblique;">Kupon Gratis Ongkir</span> dengan belanja lebih dari 100k!</p>
  </div>
