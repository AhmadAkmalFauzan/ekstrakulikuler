<?php
// session_start();
// if(!isset($_SESSION['username'])){
//     header("Location:login.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Ekskul</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #fdfdfd;
      padding: 40px;
      color: #333;  
    }

    .card-detail {
      background: white;
      padding: 30px;
      border-radius: 16px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      animation: fadeIn 0.5s ease;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .back {
      display: block;
      text-align: center;
      margin-top: 30px;
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }

    .back:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="card-detail">
    <h2 id="namaEkskul">Ekskul</h2>
    <p>Ini adalah halaman detail untuk ekstrakurikuler <span id="namaEkskulSpan"></span>. Di sini kamu bisa menambahkan informasi lengkap seperti jadwal latihan, pembina, prestasi, dan dokumentasi.</p>
    <a href="profilEkskul.php" class="back">← Kembali ke Profil Ekskul</a>
  </div>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const namaEkskul = urlParams.get('nama');

    document.getElementById('namaEkskul').textContent = namaEkskul;
    document.getElementById('namaEkskulSpan').textContent = namaEkskul;
  </script>
</body>
</html>
