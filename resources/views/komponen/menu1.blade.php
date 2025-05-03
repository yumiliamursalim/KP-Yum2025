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
            @guest
            <li><a href="/sesi">Akun</a></li> <!-- Tampil hanya jika belum login -->
            @endguest
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
  
  @auth
    @if (Auth::user()->role === 'admin')
    
    @else

    @endif
      
  @else

  @endauth
<!-- announcement -->
  <div class="announcement">
    @auth
        @if(Auth::user()->role === 'admin')
            <p>Halo <strong>Admin</strong>, kelola toko dengan bijak!</p>
        @else
            <p>Dapatkan <span style="font-style: oblique;">Kupon Gratis Ongkir</span> dengan belanja lebih dari 100k!</p>
        @endif
    @else
        <p>Dapatkan <span style="font-style: oblique;">Kupon Gratis Ongkir</span> dengan belanja lebih dari 100k!</p>
    @endauth
  </div>


@if (session('success'))
    <div id="toast-success" class="toast-popup alert alert-success">
        <span class="close-toast" onclick="closeToast()">&times;</span>
        {{ session('success') }}
    </div>

    <script>
        function closeToast() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 500);
            }
        }

        // Auto-close after 5 seconds
        setTimeout(closeToast, 5000);
    </script>

    <style>
        .toast-popup {
            position: fixed;
            top: 20px;
            right: -350px; /* mulai dari luar kanan layar */
            max-width: 300px;
            padding: 15px 20px;
            background-color: #ffffff;
            color: #000;
            border: 2px solid greenyellow;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 9999;
            opacity: 1;
            animation: slideInRight 0.5s forwards;
        }

        @keyframes slideInRight {
            to {
                right: 20px;
            }
        }

        .close-toast {
            position: absolute;
            top: 5px;
            right: 10px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
@endif




