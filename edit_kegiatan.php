<?php 
include 'header.php'; 
include 'koneksi.php'; 

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

// Proses Update Data
if (isset($_POST['update'])) {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi = $_POST['deskripsi'];

    if ($_FILES['foto']['name'] != "") {
        $target_dir = "uploads/";
        $foto = $target_dir . basename($_FILES["foto"]["name"]);
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto)) {
            // Hapus foto lama
            if (file_exists($data['foto'])) {
                unlink($data['foto']);
            }
            $query = "UPDATE kegiatan SET nama_kegiatan='$nama_kegiatan', deskripsi='$deskripsi', foto='$foto' WHERE id='$id'";
        }
    } else {
        $query = "UPDATE kegiatan SET nama_kegiatan='$nama_kegiatan', deskripsi='$deskripsi' WHERE id='$id'";
    }

    mysqli_query($conn, $query);
    header("Location: kegiatan.php");
}
?>

<div class="container">
    <h1>Edit Kegiatan</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nama_kegiatan" value="<?= $data['nama_kegiatan']; ?>" required>
        <textarea name="deskripsi" required><?= $data['deskripsi']; ?></textarea>
        <input type="file" name="foto">
        <img src="<?= $data['foto']; ?>" width="100">
        <button type="submit" name="update">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
