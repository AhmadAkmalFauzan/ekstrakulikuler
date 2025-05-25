<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/side.css">

	<title>X-Track</title>
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
			<li>
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
			<li class="active">
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

    <section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<!-- <a href="#" class="nav-link">Categories</a>
			 <form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form> --> 
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<!-- <a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a> -->
			<a href="profil.php" class="profile">
                <i class='bx bx-user-circle' style="font-size: 32px; color: #000;"></i>
            </a>
		</nav>

<script src="js/dashboard.js"></script>
<script>
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
	setInterval(updateClock, 1000);
	updateClock();
</script>

</body>
</html>

