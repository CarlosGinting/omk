<?php 
include 'header.php'; 
include 'koneksi.php'; 

// Proses Tambah Diskusi
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    
    $query = "INSERT INTO forum (judul, isi) VALUES ('$judul', '$isi')";
    mysqli_query($conn, $query);
}

// Ambil Data Forum
$result = mysqli_query($conn, "SELECT * FROM forum ORDER BY id DESC");
?>

<div class="container">
    <h1>Forum Diskusi</h1>

    <!-- Form Tambah Diskusi -->
    <form method="post" action="">
        <input type="text" name="judul" placeholder="Judul Diskusi" required>
        <textarea name="isi" placeholder="Isi Diskusi" required></textarea>
        <button type="submit" name="tambah">Buat Diskusi</button>
    </form>

    <!-- Daftar Diskusi -->
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="diskusi">
            <h2><a href="detail_forum.php?id=<?= $row['id']; ?>"><?= $row['judul']; ?></a></h2>
            <p><?= substr($row['isi'], 0, 100); ?>...</p>
            <small><?= $row['tanggal']; ?></small>
        </div>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>

<style>
form {
    display: flex;
    flex-direction: column;
    width: 400px;
    margin: 20px auto;
}
input, textarea, button {
    margin: 5px 0;
    padding: 10px;
}
.diskusi {
    border: 1px solid #ccc;
    padding: 15px;
    margin: 10px auto;
    width: 80%;
    border-radius: 10px;
}
h2 a {
    text-decoration: none;
    color: #007bff;
}
</style>
