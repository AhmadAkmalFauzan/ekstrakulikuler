<?php
session_start();
include "proses.php"; 

// Menampilkan data POST untuk debugging
// var_dump($_POST);
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debugging: Cek apakah POST data dikirim

    // Cek login
    if (loginUser($username, $password)) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login berhasil!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location.href='login.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logreg.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <img src="img/logo24.png" alt="Logo" class="logo"> <!-- Ganti dengan path logo Anda -->
            <h1>Login</h1>
            <form action="" method="post">
                <input type="text" placeholder="Username" required name="username" pattern="[a-zA-Z0-9\s.,!?()-]+" maxlength="8" > 
                <input type="password" placeholder="Password" required minlength="8" name="password"  pattern="[a-zA-Z0-9\s.,!?()-]+">
                <button type="submit" name="submit">Login</button>
            </form>
            <p>Sudah punya akun? <a href="registrasi.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>