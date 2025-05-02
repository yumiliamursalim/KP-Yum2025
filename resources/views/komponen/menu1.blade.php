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

  <ul class="navbar-nav ms-auto">
    @auth
        <li class="nav-item">
            <span class="nav-link text-white">Halo, {{ Auth::user()->name }}</span>
        </li>
        <li class="nav-item">
            <a href="/sesi/logout" class="nav-link text-white">Logout</a>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ url('/sesi') }}" class="nav-link text-white">Login</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/register') }}" class="nav-link text-white">Register</a>
        </li>
    @endauth
</ul>

@if (session('success'))
    <div id="toast-success" class="toast-popup alert alert-success">
        {{ session('success') }}
    </div>

    <script>
        // Hapus toast setelah 5 detik
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 5000);
    </script>

    <style>
        .toast-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: auto;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            border: 2px solid greenyellow;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: opacity 0.5s ease;
        }
    </style>
@endif


