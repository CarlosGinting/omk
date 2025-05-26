<?php 
include 'header.php'; 
include 'koneksi.php'; 

$id = $_GET['id'];
$forum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM forum WHERE id='$id'"));

// Proses Tambah Komentar
if (isset($_POST['tambah_komentar'])) {
    $nama = $_POST['nama'];
    $isi = $_POST['isi'];
    
    $query = "INSERT INTO komentar (forum_id, nama, isi) VALUES ('$id', '$nama', '$isi')";
    mysqli_query($conn, $query);
}

// Ambil Data Komentar
$komentar = mysqli_query($conn, "SELECT * FROM komentar WHERE forum_id='$id' ORDER BY id DESC");
?>

<div class="container">
    <h1><?= $forum['judul']; ?></h1>
    <p><?= $forum['isi']; ?></p>
    <small><?= $forum['tanggal']; ?></small>

    <h2>Komentar</h2>
    
    <!-- Form Tambah Komentar -->
    <form method="post" action="">
        <input type="text" name="nama" placeholder="Nama Anda" required>
        <textarea name="isi" placeholder="Tulis komentar..." required></textarea>
        <button type="submit" name="tambah_komentar">Kirim Komentar</button>
    </form>

    <!-- Daftar Komentar -->
    <?php while ($row = mysqli_fetch_assoc($komentar)) { ?>
        <div class="komentar">
            <strong><?= $row['nama']; ?></strong>
            <p><?= $row['isi']; ?></p>
            <small><?= $row['tanggal']; ?></small>
        </div>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>

<style>
.komentar {
    border: 1px solid #ddd;
    padding: 10px;
    margin: 10px 0;
    border-radius: 8px;
    background: #f9f9f9;
}
</style>
