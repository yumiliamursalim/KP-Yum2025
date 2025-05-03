@auth
<!-- Tombol Akun -->
<div class="account-float">
  <button onclick="toggleDropdown()" class="account-btn">Akun</button>

  <!-- Dropdown -->
  <div id="accountDropdown" class="dropdown-box">
    <ul>
      <li><a href="/profile">Profil</a></li>
      <li>
        <form method="GET" action="/sesi/logout" onsubmit="return confirmLogout()">
          @csrf
          <button type="submit" class="logout-btn" >Logout</button>
        </form>
      </li>
    </ul>
  </div>
</div>

<style>
    .account-float {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 999;
}

.account-btn {
  padding: 10px 20px;
  background-color: yellowgreen;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: background-color 0.3s ease;
}

.account-btn:hover {
  background-color: #21867a;
}

.dropdown-box {
  display: none;
  position: absolute;
  bottom: 50px;
  right: 0;
  background-color: #ffffff;
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 180px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  animation: slideIn 0.3s ease-out;
}

.dropdown-box ul {
  list-style: none;
  margin: 0;
  padding: 10px;
}

.dropdown-box li {
  margin: 5px 0;
}

.dropdown-box a,
.logout-btn {
  text-decoration: none;
  color: #333;
  display: block;
  padding: 8px;
  border-radius: 5px;
  transition: background 0.2s;
  width: 100%;
  text-align: left;
  background: none;
  border: none;
  cursor: pointer;
}

.dropdown-box a:hover,
.logout-btn:hover {
  background-color: #f2f2f2;
}

@keyframes slideIn {
  from {
    transform: translateX(20px);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}


</style>
<script>
  function toggleDropdown() {
    const dropdown = document.getElementById('accountDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }

  // Optional: tutup dropdown kalau klik di luar
  window.addEventListener('click', function (e) {
    const dropdown = document.getElementById('accountDropdown');
    const button = document.querySelector('.account-btn');
    if (!dropdown.contains(e.target) && !button.contains(e.target)) {
      dropdown.style.display = 'none';
    }
  });
  function confirmLogout() {
      return confirm("Apa kamu yakin ingin logout?");
    }

</script>

@endauth
