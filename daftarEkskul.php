<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once "koneksi.php";
$koneksi = koneksi();

// Mengambil data siswa berdasarkan username yang tersimpan di session
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$siswa = $result->fetch_assoc();

$stmt->close();
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ekskul</title>
    <link rel="stylesheet" href="css/styleAbsenDaftar.css">
</head>
<body>    
    <form method="POST" action="proses.php">
        <input type="hidden" name="aksi" value="daftar_ekskul">
        <!-- desain form -->
        <div class="form-container">
            <div class="form-header">
                <h1>Formulir Pendaftaran Ekstrakurikuler</h1>
            </div>
            
            <div class="form-group">
                <label for="nisn">NISN</label>
                <input type="text" id="nisn" name="nisn" value="<?= $siswa['nisn'] ?>" readonly>
            </div>
            
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= $siswa['nama'] ?>" readonly>
            </div>
            
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" value="<?= $siswa['kelas'] ?>" readonly>
            </div>
            
            <div class="form-group">
                <label for="ekskul">Pilih Ekstrakurikuler</label>
                <select id="ekskul" name="id_ekskul" required>
                    <option value="">-- Pilihan Ekstrakurikuler --</option>
                    <?php
                    // Mengambil data ekstrakurikuler dari database
                    $koneksi = koneksi();
                    $sql = "SELECT * FROM list_ekskul";
                    $result = $koneksi->query($sql);
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['id_ekskul']."'>".$row['nama_ekskul']."</option>";
                    }
                    $koneksi->close();
                    ?>
                </select>
            </div>
            
            <!-- Include hidden id_user input -->
            <input type="hidden" name="id_user" value="<?= $siswa['id_user'] ?>">
            <input type="hidden" name="action" value="daftar_ekskul">
            
            <button type="submit" class="submit-btn">Daftar</button>
            <a href="dashboard.php" class="back-btn">Kembali</a>
        </div>
    </form>
</body>
</html>