<?php
session_start();
include "proses.php";

if (isset($_POST['submit'])) {
    $nisn = $_POST['nisn'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];

    if (registrasiUser($nisn, $username, $nama, $kelas, $password)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); window.location.href='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logreg.css">
    <title>Registrasi</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <img src="img/logo24.png" alt="Logo" class="logo"> <!-- Ganti dengan path logo Anda -->
            <h1>Registrasi</h1>
            <form action="" method="post">
                <input type="number" placeholder="NISN" name="nisn" required >
                <input type="text" name="nama" placeholder="Nama" required max="16" pattern="[a-zA-Z0-9\s.,!?()-]+">
                <input type="text" placeholder="Username" required name="username" pattern="[a-zA-Z0-9\s.,!?()-]+" > 

                <select name="kelas" required>
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="X ULW">X ULW</option>
                <option value="X RPL 1">X RPL 1</option>
                <option value="X RPL 2">X RPL 2</option>
                <option value="X KUL 1">X KUL 1</option>
                <option value="X KUL 2">X KUL 2</option>
                <option value="X KUL 3">X KUL 3</option>
                <option value="X PH 1">X PH 1</option>
                <option value="X PH 2">X PH 2</option>
                <option value="X PH 3">X PH 3</option>
                <option value="X BSN 1">X BSN 1</option>
                <option value="X BSN 2">X BSN 2</option>
                <option value="X BSN 3">X BSN 3</option>
                <option value="XI ULW">XI ULW</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI KUL 1">XI KUL 1</option>
                <option value="XI KUL 2">XI KUL 2</option>
                <option value="XI KUL 3">XI KUL 3</option>
                <option value="XI PH 1">XI PH 1</option>
                <option value="XI PH 2">XI PH 2</option>
                <option value="XI PH 3">XI PH 3</option>
                </select>

                <input type="password" placeholder="Password" required minlength="8" name="password"  pattern="[a-zA-Z0-9\s.,!?()-]+">
                <button type="submit" name="submit">Daftar Sekarang</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
        </div>
    </div>
</body>
</html>