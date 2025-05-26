<?php
$host = "localhost";  // Sesuaikan dengan host server
$user = "root";       // Sesuaikan dengan username database
$pass = "";           // Sesuaikan dengan password database
$db   = "omk_db";     // Nama database yang dibuat tadi

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
