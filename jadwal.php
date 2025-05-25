<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>X-Track</title>
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/side.css" />
    <link rel="stylesheet" href="css/jadw.css" />
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
			<li class="active">
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

<!-- CONTENT -->
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
    <!-- END NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
				<div class="left">
					<h1>Jadwal Ekskul</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Jadwal Ekskul</a>
						</li>
					</ul>
				</div>
			</div>

        <div class="container">
            <!-- Jadwal kartu -->
            <div class="card-container">

                <!-- Senin -->
             <div class="card olahraga">
                    <div class="card-header">
                        <div class="card-title">Voli</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Senin</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Upacara</div>
                        </div>
                    </div>
                    <div class="card-category">Olahraga</div>
                </div>

                <div class="card keagamaan">
                    <div class="card-header">
                        <div class="card-title">RohKris</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Senin</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Ruang RohKris</div>
                        </div>
                    </div>
                    <div class="card-category">Keagamaan</div>
                </div>

                <div class="card olahraga">
                    <div class="card-header">
                        <div class="card-title">Pencak Silat</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Senin</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Tribun</div>
                        </div>
                    </div>
                    <div class="card-category">Olahraga</div>
                </div>

                <!-- Selasa -->
                <div class="card kepemimpinan">
                    <div class="card-header">
                        <div class="card-title">Paskibra</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Selasa & Kamis</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Upacara</div>
                        </div>
                    </div>
                    <div class="card-category">Kepemimpinan</div>
                </div>

                <div class="card olahraga">
                    <div class="card-header">
                        <div class="card-title">Basket</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Selasa</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Tribun</div>
                        </div>
                    </div>
                    <div class="card-category">Olahraga</div>
                </div>

                <div class="card kesenian">
                    <div class="card-header">
                        <div class="card-title">Tari Tradisional</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Selasa</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Tribun</div>
                        </div>
                    </div>
                    <div class="card-category">Kesenian</div>
                </div>

                <div class="card kesenian">
                    <div class="card-header">
                        <div class="card-title">Ratoh Jaroe</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Selasa</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Auditorium</div>
                        </div>
                    </div>
                    <div class="card-category">Kesenian</div>
                </div>

                <div class="card kesenian">
                    <div class="card-header">
                        <div class="card-title">Modern Dance</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Selasa</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Auditorium</div>
                        </div>
                    </div>
                    <div class="card-category">Kesenian</div>
                </div>

                <!-- Rabu -->
                <div class="card kepemimpinan">
                    <div class="card-header">
                        <div class="card-title">Pramuka</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Rabu</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Upacara</div>
                        </div>
                    </div>
                    <div class="card-category">Kepemimpinan</div>
                </div>

                <!-- kamis -->
                <div class="card sosial">
                    <div class="card-header">
                        <div class="card-title">PMR</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Kamis</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Ruang UKS</div>
                        </div>
                    </div>
                    <div class="card-category">Kepemimpinan</div>
                </div>

                <div class="card sosial">
                    <div class="card-header">
                        <div class="card-title">PIK-R</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Kamis</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Ruang Kelas</div>
                        </div>
                    </div>
                    <div class="card-category">Sosial</div>
                </div>

                <!-- jumat -->
                <div class="card keagamaan">
                    <div class="card-header">
                        <div class="card-title">RohIs</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Jumat</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Masjid</div>
                        </div>
                    </div>
                    <div class="card-category">Keagamaan</div>
                </div>

                <div class="card olahraga">
                    <div class="card-header">
                        <div class="card-title">Futsal</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Hari</div>
                            <div class="info-value">Jumat</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Jam</div>
                            <div class="info-value">15:00 - 17:00</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">Lapangan Tribun</div>
                        </div>
                    </div>
                    <div class="card-category">Olahraga</div>
                </div>
            </div>
        </div>
    </main>
    <!-- END MAIN -->
</section>
<!-- END CONTENT -->
<!-- <script src="js/dashboard.js"></script> -->
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

    // Dark mode toggle
    const switchMode = document.getElementById('switch-mode');
    switchMode.addEventListener('change', function() {
        if(this.checked) {
            document.body.classList.add('dark');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            document.body.classList.remove('dark');
            localStorage.setItem('darkMode', 'disabled');
        }
    });

    // Periksa localStorage untuk mode sebelumnya
    if(localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark');
        document.getElementById('switch-mode').checked = true;
    }

    const toggle = document.getElementById('toggle-mode');
    toggle.addEventListener('change', function() {
        document.body.classList.toggle('dark');
    });
</script>

<script>
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

    allSideMenu.forEach(item=> {
        const li = item.parentElement;

        item.addEventListener('click', function () {
            allSideMenu.forEach(i=> {
                i.parentElement.classList.remove('active');
            })
            li.classList.add('active');
        })
    });

    // TOGGLE SIDEBAR
    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');

    menuBar.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    })

    searchButton.addEventListener('click', function (e) {
        if(window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if(searchForm.classList.contains('show')) {
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    })

    if(window.innerWidth < 768) {
        sidebar.classList.add('hide');
    } else if(window.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }


    window.addEventListener('resize', function () {
        if(this.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    })
</script>
</body>
</html>
