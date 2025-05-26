<?php
include 'phpqrcode/qrlib.php';
$nama = $_POST['nama'];
$folder = "qrcodes/";

if (!file_exists($folder)) {
    mkdir($folder);
}

$filename = $folder . uniqid() . ".png";
QRcode::png($nama, $filename, QR_ECLEVEL_L, 10);

$conn = new mysqli("localhost", "root", "", "absensi_omk");
$conn->query("INSERT INTO anggota (nama, qr_code) VALUES ('$nama', '$filename')");

echo "QR Code berhasil dibuat! <br>";
echo "<img src='$filename'>";
?>
