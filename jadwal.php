<?php
// include "proses.php";
// session_start();
// if(!isset($_SESSION['username'])){
// 	header("Location:login.php");
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/jadwal.css">

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
			<li >
				<a href="dashboard.php">
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
							<a href="jadwal.php">Jadwal Ekskul</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="dashboard.php">Dashboard</a>
						</li>
					</ul>
		</main>
        </div>
            <div class="container">
        <h2><i class='bx bx-calendar'></i> Jadwal Ekstrakurikuler</h2>

    <table>
      <thead>
        <tr>
          <th>Hari</th>
          <th>Ekstrakurikuler</th>
          <th>Waktu</th>
          <th>Tempat</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Hari">Senin</td>
          <td data-label="Ekstrakurikuler">Volix</td>
          <td data-label="Waktu">15.30 - 17.00</td>
          <td data-label="Tempat">Lapangan Basket</td>
        </tr>
        <tr>
          <td data-label="Hari">Selasa</td>
          <td data-label="Ekstrakurikuler">Futsal</td>
          <td data-label="Waktu">15.30 - 17.00</td>
          <td data-label="Tempat">Lapangan Indoor</td>
        </tr>
        <tr>
          <td data-label="Hari">Rabu</td>
          <td data-label="Ekstrakurikuler">Paskibra</td>
          <td data-label="Waktu">15.30 - 17.00</td>
          <td data-label="Tempat">Lapangan Upacara</td>
        </tr>
        <tr>
          <td data-label="Hari">Kamis</td>
          <td data-label="Ekstrakurikuler">Pramuka</td>
          <td data-label="Waktu">15.30 - 17.30</td>
          <td data-label="Tempat">Lapangan Serbaguna</td>
        </tr>
        <tr>
          <td data-label="Hari">Jumat</td>
          <td data-label="Ekstrakurikuler">Rohis</td>
          <td data-label="Waktu">13.00 - 14.30</td>
          <td data-label="Tempat">Ruang Rohani</td>
        </tr>
      </tbody>
    </table>
  </div>        
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="js/dashboard.js"></script>
</body>
</html>