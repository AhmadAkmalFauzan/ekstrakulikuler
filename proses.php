<?php
require_once "koneksi.php";

function loginUser($username, $password) {
    $koneksi = koneksi();
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Debugging: Cek password yang disimpan
        var_dump($row['password']);  // Tambahkan ini untuk melihat password yang disimpan di DB

        if (password_verify($password, $row['password'])) {
            // Set session data jika login berhasil
            $_SESSION['nisn'] = $row['nisn'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['kelas'] = $row['kelas'];
            return true;
        }
    }
    return false;
}
 
function registrasiUser($nisn, $username, $nama, $kelas, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // lebih aman daripada md5
    $koneksi = koneksi();
    $sql = "INSERT INTO user(nisn, username, nama, kelas, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssss", $nisn, $username, $nama, $kelas, $hashed_password);
    $result = $stmt->execute();
    $stmt->close();
    $koneksi->close();
    return $result;
}

?>