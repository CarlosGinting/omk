<?php
$conn = new mysqli("localhost", "root", "", "absensi_omk");
$nama = $_GET['nama'];

$result = $conn->query("SELECT id FROM anggota WHERE nama='$nama'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $anggota_id = $row['id'];
    $conn->query("INSERT INTO absensi (anggota_id) VALUES ('$anggota_id')");
    echo "Absensi berhasil!";
} else {
    echo "Anggota tidak ditemukan.";
}
?>
