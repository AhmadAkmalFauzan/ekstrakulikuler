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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/logreg.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-up {
      animation: fadeUp 0.7s ease-out both;
    }
  </style>
</head>
<body class="h-screen flex overflow-hidden bg-gray-100">

  <!-- Panel Form -->
  <div class="w-1/2 flex flex-col justify-center items-center px-8 bg-white fade-up">
    <h2 class="text-3xl font-bold mb-6">Login</h2>
    <form class="w-full max-w-sm space-y-4" method="post">
      <input type="hidden" name="aksi" value="login">

      <input type="text" placeholder="Username" name="username" pattern="[a-zA-Z0-9\s.,!?()-]+" required class="w-full border border-gray-300 rounded-xl px-4 py-2 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md" />
      
      <div class="relative">
        <input type="password" placeholder="Password" name="password" pattern="[a-zA-Z0-9\s.,!?()-]+" required class="w-full border border-gray-300 rounded-xl px-4 py-2 pr-10 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:shadow-md" />
        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-700">
          👁️
        </button>
      </div>

        <input type="submit" name="submit" class="btn btn-primary" value="Login">
      <p class="text-sm text-gray-600 text-center">
        Belum punya akun? <a href="registrasi.php" class="text-blue-600 hover:underline">Registrasi di sini</a>
      </p>
    </form>
  </div>

  <!-- Garis Lurus -->
  <div class="w-px bg-gray-300"></div>

  <!-- Panel Gambar -->
  <div class="w-1/2 bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center relative text-white fade-up">
    <div class="absolute top-5 right-5 font-bold text-lg">X-TRACK</div>
    <img src="img/logoLogin.png" alt="Shield Icon" class="w-2/3 max-w-xs drop-shadow-2xl">
  </div>

  <script>
    // Password toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Find all password toggle buttons
        const toggleButtons = document.querySelectorAll('button[type="button"]');
        
        toggleButtons.forEach(button => {
            // Check if this button is next to a password input
            const passwordInput = button.parentElement.querySelector('input[type="password"], input[type="text"]');
            
            if (passwordInput && (passwordInput.type === 'password' || passwordInput.name === 'password')) {
                button.addEventListener('click', function() {
                    togglePassword(passwordInput, button);
                });
            }
        });
    });

    function togglePassword(passwordInput, toggleButton) {
        if (passwordInput.type === 'password') {
            // Show password
            passwordInput.type = 'text';
        } else {
            // Hide password
            passwordInput.type = 'password';
        }
    }
  </script>

</body>
</html>