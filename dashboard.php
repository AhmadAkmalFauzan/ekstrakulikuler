<?php
include "proses.php";
session_start();
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="icon" type="image/x-icon" href="img/logo24.png">
	<!-- Tambahkan ini di dalam tag <head> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- My CSS -->
	 <link rel="stylesheet" href="css/side.css">
	<link rel="stylesheet" href="css/dashboard.css">
	

	<title>X-stra</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">X-Track</span>
		</a>
		<div class="waktu">
		<div class="date" id="date">--</div>
        <div class="clock" id="clock">--:--:--</div>
		</div>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>			
			</li>
			<li>
				<a href="profilEkskul.php">
				<i class='bx bx-building-house'></i>
					<span class="text">Profil ekskul</span>
				</a>
			</li>
			<li>
				<a href="jadwal.php">
				<i class='bx bx-calendar'></i>
					<span class="text">Jadwal ekskul</span>
				</a>
			</li>
			<li>
				<a href="history.php">
				<i class='bx bx-time'></i>
					<span class="text">History</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
				</div>
				<div class="right-buttons">
					<a href="daftarEkskul.php" class="btn-dashboard">Registrasi</a>
					<a href="absenEkskul.php" class="btn-dashboard">Absen</a>
				</div>
			</div>
			<div class="profile-wrapper">
			<div class="character-container">
			<img src="img/orang.png" alt="">
			</div>	
			<div class="info-card">
           <h1>Halo, <span><?php echo $_SESSION['username'] ?></span></h1>
		   <h1>Selamat Datang!</h1>
           <p class="description">
			Selamat Datang di situs resmi kegiatan Ekstrakulikuler!
			Temukan informasi lengkap tentang berbagai kegiatan Ekstrakulikuler
          </p>
         </div>
			</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="js/dashboard.js"></script>
</body>
</html>