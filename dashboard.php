<?php
session_start();
include "proses.php";
if(!isset($_SESSION['username'])) header("Location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sidebar Hamburger</title>
  <link rel="stylesheet" href="css/dashboard.css">
  <!-- <script src="js/dashboard.js"></script> -->
</head>
<body>

  <!-- Hamburger Button -->
  <div class="hamburger" class="overlay" id="overlay" onclick="toggleSidebar()">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <!-- Sidebar -->
  <div class="sidebar closed" id="sidebar">
    <div class="logo">
       <h1>X-Track</h1>
    </div>
    <br><br>
    <div class="date" id="date">--</div>
    <div class="clock" id="clock">--:--:--</div>
    <hr />
    <div class="menu-title">Main menu</div>
    <nav class="menu">
  <a href="#" class="menu-item">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
  </svg>
    Dashboard
  </a>
  <a href="profilEkskul.php" class="menu-item">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
  </svg>
    Profil Ekskul
  </a>
  <a href="#" class="menu-item">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 18px; height: 18px;">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
    </svg>
    Jadwal Ekskul
  </a>
</nav>
  </div>
  <div class="topbar">
    <div class="welcome-container">
    <h1 class="welcome-text">Good Morning, <span class="text-bold"><?php echo htmlspecialchars($_SESSION['username']); ?></span></h1>

    </div>
    <div class="search-container">
    <div class="search-box">
      <svg viewBox="0 0 24 24">
        <path d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" 
              stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <input type="text" id="searchInput" placeholder="Search..." oninput="handleSearch(this.value)" />
    </div>
    <ul id="results" class="results"></ul>
  </div>
    <img src="img/raisol.jpg" alt="User" class="profile-pic" onclick="toggleDropdown()" />
  <div class="dropdown" id="dropdownMenu">
    <div class="dropdown-header">
      <img src="img/raisol.jpg" alt="User">
      <p style="color:gray">NISN: <span><?php echo htmlspecialchars($_SESSION['nisn']); ?></span></p>
      <p style="color:gray">Nama: <span><?php echo htmlspecialchars($_SESSION['nama']); ?></span></p>
      <p style="color:gray">Kelas: <span><?php echo htmlspecialchars($_SESSION['kelas']); ?></span></p>
    </div>
    <div class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="roun d" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
    </svg>
     My Profile
    </div>
    <div class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
     History</div>
    <div class="dropdown-item">
      <a href="logout.php" class="menu-item">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
      </svg>Sign Out
      </a>
      </div>
  </div>
</div>



</body>
</html>

<script>

// const hamburger = document.querySelector('.hamburger');
const sidebar = document.querySelector('.sidebar');
// const topbar = document.querySelector('.topbar');
// const welcomeContainer = document.querySelector('.welcome-container');


function toggleSidebar() {
  sidebar.classList.toggle('closed');
  topbar.classList.toggle('shifted');
  welcomeContainer.classList.toggle('shifted-vertical');
}

function updateClock() {
  const now = new Date();
  const date = now.toLocaleDateString('en-GB', {
    day: '2-digit', month: 'short', year: 'numeric'
  });
  const time = now.toLocaleTimeString('en-GB', {
    hour: '2-digit', minute: '2-digit', second: '2-digit'
  });
  document.getElementById('date').textContent = date;
  document.getElementById('clock').textContent = time;
}

function toggleDropdown() {
  const dropdown = document.getElementById('dropdownMenu');
  dropdown.classList.toggle('active');
}


setInterval(updateClock, 1000);
updateClock();
</script>
