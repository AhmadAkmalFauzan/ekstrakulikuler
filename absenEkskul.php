<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION['nisn'])) {
    header("Location: login.php");
    exit;
}

$koneksi = koneksi();
$username = $_SESSION['username'];

// Ambil data user dan ekskul
$sql = "SELECT u.id_user, u.nama, u.kelas, e.id_ekskul, e.nama_ekskul 
        FROM user u 
        LEFT JOIN peserta_ekskul p ON u.id_user = p.id_user 
        LEFT JOIN list_ekskul e ON p.id_ekskul = e.id_ekskul 
        WHERE u.username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$id_user = $data['id_user'];
$id_ekskul = $data['id_ekskul'];
$nama = $data['nama'];
$kelas = $data['kelas'];
$nama_ekskul = $data['nama_ekskul'];

$stmt->close();
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Absen Ekskul</title>
    <link rel="stylesheet" href="css/styleAbsenDaftar.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>Formulir Absensi</h1>
        </div>

        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="absen_ekskul">
            <input type="hidden" name="id_user" value="<?= $id_user ?>">
            <input type="hidden" name="id_ekskul" value="<?= $id_ekskul ?>">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= $nama ?>" readonly>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" value="<?= $kelas ?>" readonly>
            </div>

            <div class="form-group">
                <label for="ekskul">Ekstrakurikuler</label>
                <input type="text" id="ekskul" name="ekskul" value="<?= $nama_ekskul ?>" readonly>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" max="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <label class="custom-file-upload">
                    <input type="file" name="foto" id="foto" accept="image/*" required>
                    Pilih Gambar
                </label>
                <img id="preview" src="#" alt="Preview Foto" style="display:none; max-width: 100%; border-radius: 10px;">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Kirim</button>
            <a href="dashboard.php" class="back-btn">Kembali</a>
        </form>
    </div>

<script>
    // Preview gambar saat dipilih
    document.getElementById("foto").onchange = function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById("preview");
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        }
    };
</script>
</body>
</html>
