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

// Mendapatkan data user dari database
$koneksi = koneksi();
$sql = "SELECT * FROM user WHERE id_user = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

$stmt->close();
$koneksi->close();

// Jika data tidak ditemukan, redirect ke login
if (!$userData) {
    session_destroy();
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="img/logo24.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Profil - X-Track</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f0f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .profile-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            max-width: 800px;
            width: 100%;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .profile-avatar i {
            font-size: 60px;
            color: white;
        }

        .profile-header h1 {
            color: #333;
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 600;
        }

        .profile-header p {
            color: #666;
            margin: 0;
            font-size: 16px;
        }

        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .info-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .info-item label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item .value {
            font-size: 18px;
            color: #555;
            font-weight: 500;
        }

        .info-item i {
            color: #667eea;
            margin-right: 10px;
            font-size: 20px;
        }

        .btn-back {
            background: #4f46e5;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
        }

        .btn-back:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .profile-container {
                padding: 20px;
            }
            
            .profile-info {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .profile-avatar {
                width: 100px;
                height: 100px;
            }
            
            .profile-avatar i {
                font-size: 50px;
            }
            
            .profile-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <a href="dashboard.php" class="btn-back">
            <i class='bx bx-arrow-back'></i>
            Kembali
        </a>

        <div class="profile-header">
            <div class="profile-avatar">
                <i class='bx bx-user'></i>
            </div>
            <h1><?php echo htmlspecialchars($userData['nama'] ?? 'Nama tidak tersedia'); ?></h1>
            <p>Siswa - Kelas <?php echo htmlspecialchars($userData['kelas'] ?? 'Kelas tidak tersedia'); ?></p>
        </div>

        <div class="profile-info">
            <div class="info-item">
                <label><i class='bx bx-id-card'></i>NISN</label>
                <div class="value"><?php echo htmlspecialchars($userData['nisn'] ?? 'NISN tidak tersedia'); ?></div>
            </div>

            <div class="info-item">
                <label><i class='bx bx-user'></i>Nama Lengkap</label>
                <div class="value"><?php echo htmlspecialchars($userData['nama'] ?? 'Nama tidak tersedia'); ?></div>
            </div>

            <div class="info-item">
                <label><i class='bx bx-at'></i>Username</label>
                <div class="value"><?php echo htmlspecialchars($userData['username'] ?? 'Username tidak tersedia'); ?></div>
            </div>

            <div class="info-item">
                <label><i class='bx bx-home-alt'></i>Kelas</label>
                <div class="value"><?php echo htmlspecialchars($userData['kelas'] ?? 'Kelas tidak tersedia'); ?></div>
            </div>

            <?php if (isset($userData['email']) && !empty($userData['email'])): ?>
            <div class="info-item">
                <label><i class='bx bx-envelope'></i>Email</label>
                <div class="value"><?php echo htmlspecialchars($userData['email']); ?></div>
            </div>
            <?php endif; ?>

            <?php if (isset($userData['tanggal_daftar']) && !empty($userData['tanggal_daftar'])): ?>
            <div class="info-item">
                <label><i class='bx bx-calendar'></i>Tanggal Daftar</label>
                <div class="value"><?php echo date('d F Y', strtotime($userData['tanggal_daftar'])); ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>