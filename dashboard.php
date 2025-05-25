<?php
session_start();
include "proses.php";

if(!isset($_SESSION['username'])){
    header("Location:login.php");
    exit;
}

// Pastikan id_user tersedia di session
if (!isset($_SESSION['id_user'])) {
    session_destroy();
    header("Location:login.php");
    exit;
}

// Cek apakah user sudah terdaftar di ekstrakurikuler
$isRegistered = isRegisteredInAnyEkskul($_SESSION['id_user']);

// Debug - uncomment untuk testing jika diperlukan
// echo "<!-- Debug: User ID = " . $_SESSION['id_user'] . ", isRegistered = " . ($isRegistered ? 'true' : 'false') . " -->";
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
    
    <style>
        .notification-banner {
            background: linear-gradient(135deg, #ff6b6b, #ffa500);
            color: white;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 10px;
            border-left: 5px solid #ff4757;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            animation: slideIn 0.5s ease-out;
        }
        
        .notification-banner h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .notification-banner p {
            margin: 0 0 15px 0;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .notification-banner .btn-register {
            background: white;
            color: #ff6b6b;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .notification-banner .btn-register:hover {
            background: #f1f1f1;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .close-btn {
            float: right;
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-top: -5px;
        }
        
        .btn-disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
            background: #ccc !important;
            color: #666 !important;
            text-decoration: none;
            pointer-events: none;
            position: relative;
        }
        
        .btn-disabled:hover {
            background: #ccc !important;
            color: #666 !important;
            transform: none !important;
        }

        .success-banner {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 10px;
            border-left: 5px solid #155724;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            animation: slideIn 0.5s ease-out;
        }
        
        .success-banner h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .success-banner p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
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
            <a href="profil.php" class="profile">
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
                    <a href="daftarEkskul.php" class="btn-dashboard">
                        <i class='bx bx-user-plus'></i> Registrasi
                    </a>
                    <?php if ($isRegistered): ?>
                        <a href="absenEkskul.php" class="btn-dashboard">
                            <i class='bx bx-calendar-check'></i> Absen
                        </a>
                    <?php else: ?>
                        <span class="btn-dashboard btn-disabled" title="Daftar ekstrakurikuler terlebih dahulu untuk mengakses fitur absen">
                            <i class='bx bx-lock'></i> Absen
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!$isRegistered): ?>
            <!-- Notification Banner untuk user yang belum daftar ekskul -->
            <div class="notification-banner" id="notificationBanner">
                <button class="close-btn" onclick="closeNotification()">&times;</button>
                <h3><i class='bx bx-info-circle'></i> Pemberitahuan Penting!</h3>
                <p>Halo <strong><?php echo htmlspecialchars($_SESSION['nama'] ?? $_SESSION['username']); ?></strong>! Kami melihat Anda belum terdaftar di ekstrakurikuler manapun. 
                Untuk dapat menggunakan fitur absensi dan mengakses semua layanan, silahkan daftar ekstrakurikuler terlebih dahulu.</p>
                <a href="daftarEkskul.php" class="btn-register">
                    <i class='bx bx-user-plus'></i> Daftar Ekstrakurikuler Sekarang
                </a>
            </div>
            <?php else: ?>
            <!-- Success Banner untuk user yang sudah terdaftar -->
            <div class="success-banner" id="successBanner">
                <button class="close-btn" onclick="closeSuccessBanner()" style="color: white;">&times;</button>
                <h3><i class='bx bx-check-circle'></i> Selamat!</h3>
                <p>Anda sudah terdaftar di ekstrakurikuler. Sekarang Anda dapat menggunakan fitur absensi dan mengakses semua layanan yang tersedia.</p>
            </div>
            <?php endif; ?>

            <div class="profile-wrapper">
                <div class="character-container">
                    <img src="img/orang.png" alt="">
                </div>    
                <div class="info-card">
                    <h1>Halo, <span><?php echo htmlspecialchars($_SESSION['nama'] ?? $_SESSION['username']); ?></span></h1>
                    <h1>Selamat Datang!</h1>
                    <p class="description">
                        Selamat Datang di situs resmi kegiatan Ekstrakurikuler!
                        Temukan informasi lengkap tentang berbagai kegiatan Ekstrakurikuler
                    </p>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="js/dashboard.js"></script>
    <script>
        function closeNotification() {
            document.getElementById('notificationBanner').style.display = 'none';
        }
        
        function closeSuccessBanner() {
            const banner = document.getElementById('successBanner');
            if (banner) {
                banner.style.display = 'none';
            }
        }

        // Auto hide success banner after 10 seconds
        <?php if ($isRegistered): ?>
        setTimeout(function() {
            closeSuccessBanner();
        }, 10000);
        <?php endif; ?>
    </script>
</body>
</html>