<?php
$conn = new mysqli("localhost", "root", "", "absensi_omk");
$result = $conn->query("SELECT anggota.nama, absensi.waktu FROM absensi 
                        JOIN anggota ON absensi.anggota_id = anggota.id 
                        ORDER BY absensi.waktu DESC");

echo "<h2>Riwayat Absensi</h2>";
echo "<table border='1'><tr><th>Nama</th><th>Waktu</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['nama']}</td><td>{$row['waktu']}</td></tr>";
}
echo "</table>";
?>
