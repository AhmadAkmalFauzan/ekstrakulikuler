<?php
require_once "koneksi.php";

// Fungsi untuk login user
function loginUser($username, $password) {
    $koneksi = koneksi();
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan data ke session
            $_SESSION['nisn'] = $row['nisn'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['kelas'] = $row['kelas'];
            $_SESSION['id_user'] = $row['id_user'];
            return true;
        }
    }
    return false;
}

// Fungsi untuk registrasi user
function registrasiUser($nisn, $username, $nama, $kelas, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $koneksi = koneksi();

    $sql = "INSERT INTO user(nisn, username, nama, kelas, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssss", $nisn, $username, $nama, $kelas, $hashed_password);
    $result = $stmt->execute();

    $stmt->close();
    $koneksi->close();

    return $result;
}

// Fungsi untuk mendaftarkan siswa ke ekstrakurikuler
function daftarEkstrakurikuler($id_user, $id_ekskul) {
    $koneksi = koneksi();
    
    // Periksa apakah siswa sudah terdaftar pada ekstrakurikuler ini
    $sql_check = "SELECT * FROM peserta_ekskul WHERE id_user = ? AND id_ekskul = ?";
    $stmt_check = $koneksi->prepare($sql_check);
    $stmt_check->bind_param("ii", $id_user, $id_ekskul);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    // Jika sudah terdaftar, tampilkan pesan
    if ($result_check->num_rows > 0) {
        $stmt_check->close();
        $koneksi->close();
        echo "<script>alert('Anda sudah terdaftar di ekstrakurikuler ini!'); window.location.href='dashboard.php';</script>";
        exit;
    }

    // Jika belum terdaftar, daftarkan
    $sql_insert = "INSERT INTO peserta_ekskul (id_user, id_ekskul) VALUES (?, ?)";
    $stmt_insert = $koneksi->prepare($sql_insert);
    $stmt_insert->bind_param("ii", $id_user, $id_ekskul);
    $result = $stmt_insert->execute();
    
    $stmt_check->close();
    $stmt_insert->close();
    $koneksi->close();
    
    if ($result) {
        echo "<script>alert('Pendaftaran ekstrakurikuler berhasil!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran ekstrakurikuler gagal!'); window.location.href='daftarEkskul.php';</script>";
    }
    exit; 
}

// Fungsi untuk cek apakah siswa terdaftar di minimal satu ekstrakurikuler
function isRegisteredInAnyEkskul($id_user) {
    $koneksi = koneksi();
    $sql = "SELECT COUNT(*) as total FROM peserta_ekskul WHERE id_user = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $total = (int)$row['total'];
    
    $stmt->close();
    $koneksi->close();
         
    return ($total > 0);
}

// Fungsi untuk absen siswa
function simpanPresensi($id_user, $id_ekskul, $tanggal, $deskripsi, $file_foto) {
    // Cek apakah user terdaftar di ekstrakurikuler yang dipilih
    $koneksi = koneksi();
    $sql_check = "SELECT * FROM peserta_ekskul WHERE id_user = ? AND id_ekskul = ?";
    $stmt_check = $koneksi->prepare($sql_check);
    $stmt_check->bind_param("ii", $id_user, $id_ekskul);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows == 0) {
        $stmt_check->close();
        $koneksi->close();
        echo "<script>alert('Anda belum terdaftar di ekstrakurikuler ini. Silahkan daftar terlebih dahulu.'); window.location.href='daftarEkskul.php';</script>";
        exit;
    }
    
    $stmt_check->close();
    
    if ($file_foto['error'] == 0) {
        $foto = file_get_contents($file_foto['tmp_name']);

        $sql = "INSERT INTO presensi_ekskul (id_user, id_ekskul, tanggal, foto, deskripsi) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("iisss", $id_user, $id_ekskul, $tanggal, $foto, $deskripsi);

        if ($stmt->execute()) {
            echo "<script>alert('Absensi berhasil disimpan!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data absensi.'); window.location.href='absenEkskul.php';</script>";
        }

        $stmt->close();
        $koneksi->close();
    } else {
        echo "<script>alert('Upload foto gagal!'); window.location.href='absenekskul.php';</script>";
    }
}

function getUserData($id_user) {
    $koneksi = koneksi();
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $stmt->close();
    $koneksi->close();
    
    return $user;
}

// Fungsi untuk update data user
function updateUserData($id_user, $nisn, $username, $nama, $kelas, $password = null) {
    $koneksi = koneksi();
    
    // Cek apakah username sudah digunakan oleh user lain
    $sql_check = "SELECT id FROM user WHERE username = ? AND id != ?";
    $stmt_check = $koneksi->prepare($sql_check);
    $stmt_check->bind_param("si", $username, $id_user);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        $stmt_check->close();
        $koneksi->close();
        return "username_exists";
    }
    
    $stmt_check->close();
    
    if ($password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET nisn = ?, username = ?, nama = ?, kelas = ?, password = ? WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssssi", $nisn, $username, $nama, $kelas, $hashed_password, $id_user);
    } else {
        $sql = "UPDATE user SET nisn = ?, username = ?, nama = ?, kelas = ? WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ssssi", $nisn, $username, $nama, $kelas, $id_user);
    }
    
    $result = $stmt->execute();
    
    $stmt->close();
    $koneksi->close();
    
    return $result;
}

// Fungsi untuk mendapatkan ekstrakurikuler yang diikuti user
function getUserEkskul($id_user) {
    $koneksi = koneksi();
    $sql = "SELECT e.* FROM ekstrakurikuler e 
            INNER JOIN peserta_ekskul pe ON e.id = pe.id_ekskul 
            WHERE pe.id_user = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $ekskul = [];
    while ($row = $result->fetch_assoc()) {
        $ekskul[] = $row;
    }
    
    $stmt->close();
    $koneksi->close();
    
    return $ekskul;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === "daftar_ekskul") {
        $id_user = $_POST['id_user'];
        $id_ekskul = $_POST['id_ekskul'];
        daftarEkstrakurikuler($id_user, $id_ekskul);

    } elseif ($aksi === "absen_ekskul") {
        $id_user   = $_POST['id_user'];
        $id_ekskul = $_POST['id_ekskul'];
        $tanggal   = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];
        simpanPresensi($id_user, $id_ekskul, $tanggal, $deskripsi, $_FILES['foto']);

    } elseif ($aksi === "register") {
        $nisn = $_POST['nisn'] ?? '';
        $username = $_POST['username'] ?? '';
        $nama = $_POST['nama'] ?? '';
        $kelas = $_POST['kelas'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (registrasiUser($nisn, $username, $nama, $kelas, $password)) {
            echo "<script>alert('Registrasi berhasil!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal!'); window.location.href='register.php';</script>";
        }
    } elseif ($aksi === "login") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (loginUser($username, $password)) {
            echo "<script>alert('Login berhasil!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Username atau password salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Aksi tidak dikenali.'); window.location.href='index.php';</script>";
    }
}
?>