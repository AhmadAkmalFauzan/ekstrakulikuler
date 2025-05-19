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
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/sidebar.css">

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
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
				<a href="#">
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
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>
			<div class="profile-wrapper">
			<div class="character-container">
			<img src="img/orang.png" alt="">
			</div>	
			<div class="info-card">
           <h1>Selamat Datang,<span><?php echo $_SESSION['username'] ?></span></h1>
           <p class="description">
            Andi adalah seorang pengembang perangkat lunak dengan pengalaman 5 tahun dalam pengembangan web dan mobile. Saat ini aktif sebagai mentor di komunitas pemrograman lokal.
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