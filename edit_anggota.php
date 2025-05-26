<?php 
include 'header.php'; 
include 'koneksi.php'; 

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM anggota WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

// Proses Update Data
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "UPDATE anggota SET nama='$nama', email='$email', telepon='$telepon', alamat='$alamat' WHERE id='$id'");
    header("Location: anggota.php");
}
?>

<div class="container">
    <h1>Edit Data Anggota</h1>
    <form method="post">
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
        <input type="email" name="email" value="<?= $data['email']; ?>" required>
        <input type="text" name="telepon" value="<?= $data['telepon']; ?>">
        <textarea name="alamat"><?= $data['alamat']; ?></textarea>
        <button type="submit" name="update">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
