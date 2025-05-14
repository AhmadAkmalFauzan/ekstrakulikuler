<?php
function koneksi() {
    $servername ="localhost";
    $username="root";
    $password="";
    $database="ekstrakulikuler";
    $koneksi=mysqli_connect($servername,$username,$password,$database);
    if($koneksi){
    // echo"Koneksi Berhasil";
    }else{
    // echo"Koneksi gagal"; 
    }
    return $koneksi;
}

?>
