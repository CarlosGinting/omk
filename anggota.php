<?php 
include 'header.php'; 
include 'koneksi.php'; 

// Proses Tambah Data
if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $query = "INSERT INTO anggota (nama, email, telepon, alamat) VALUES ('$nama', '$email', '$telepon', '$alamat')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='anggota.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    if (mysqli_query($conn, "DELETE FROM anggota WHERE id='$id'")) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='anggota.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
}

// Ambil Data Anggota
$result = mysqli_query($conn, "SELECT * FROM anggota");
?>

<div class="container">
    <h1>Data Anggota OMK</h1>

    <!-- Form Tambah Anggota -->
    <form method="post" action="">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telepon" placeholder="No Telepon">
        <textarea name="alamat" placeholder="Alamat Lengkap"></textarea>
        <button type="submit" name="tambah">Tambah Anggota</button>
    </form>

    <!-- Tabel Data Anggota -->
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['telepon']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td>
                <a href="edit_anggota.php?id=<?= $row['id']; ?>">Edit</a>
                <a href="anggota.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include 'footer.php'; ?>
<style>
form {
    display: flex;
    flex-direction: column;
    width: 300px;
    margin: 20px auto;
}
input, textarea, button {
    margin: 5px 0;
    padding: 10px;
}
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    text-align: center;
}
</style>