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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/logreg.css">
</head>
<body class="h-screen flex items-stretch bg-gray-100 overflow-hidden">

  <!-- Panel Kiri -->
  <div class="relative w-1/2 bg-gradient-to-br from-blue-600 to-blue-400 text-white flex items-center justify-center fade-in">
    <div class="absolute top-5 left-5 text-xl font-bold">X-TRACK</div>
      <img src="img/logoRegis.png" alt="Icon" class="w-2/3 max-w-xs drop-shadow-2xl z-10">
    </div>

    <!-- SVG Lekukan Modern -->
    <svg class="absolute right-0 top-0 h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
      <!-- Lekukan lebih kecil & modern -->
      <path d="M100 0 C 95 25, 95 75, 100 100 L 100 0 Z" fill="white"/>
    </svg>
  </div>

  <!-- Panel Form -->
  <div class="w-1/2 bg-white flex flex-col justify-center items-center px-8 fade-in">
    <h2 class="text-3xl font-bold mb-6">Registrasi</h2>
    <form class="w-full max-w-sm space-y-4" method="post">
      <input type="hidden" name="aksi" value="register">
      <input type="text" name="nisn" placeholder="NISN" class="w-full border border-gray-300 rounded-xl px-4 py-2 transition-all duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md" required  pattern="[a-zA-Z0-9\s.,!?()-]+" />
      <input type="text" name="nama" placeholder="Nama" class="w-full border border-gray-300 rounded-xl px-4 py-2 transition-all duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md" required  pattern="[a-zA-Z0-9\s.,!?()-]+"/>
       <input type="text" name="username" placeholder="Username" class="w-full border border-gray-300 rounded-xl px-4 py-2 transition-all duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md" required  pattern="[a-zA-Z0-9\s.,!?()-]+"/>
      <select name="kelas" class="w-full border border-gray-300 rounded-xl px-4 py-2 transition-all duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md"x required>
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
      <div class="relative">
        <input type="password" placeholder="Password" name="password" class="w-full border border-gray-300 rounded-xl px-4 py-2 pr-10 transition-all duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md" minlength="8"  pattern="[a-zA-Z0-9\s.,!?()-]+" required/>
        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-700">
          👁️
        </button>
      </div>
       <input type="submit" name="submit" class="btn btn-primary" value="Registrasi">


      <p class="text-sm text-gray-600 text-center">
        Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>
      </p>
    </form>
  </div>
</body>
</html>