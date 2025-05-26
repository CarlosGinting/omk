<?php 
include 'header.php'; 
include 'koneksi.php'; 

// Proses Upload Foto atau Video
if (isset($_POST['upload'])) {
    $judul = $_POST['judul'];
    $jenis = $_POST['jenis'];
    
    $target_dir = "uploads/";
    $file_name = time() . '_' . basename($_FILES["file"]["name"]);
    $file_path = $target_dir . $file_name;

    // Validasi tipe file
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/avi', 'video/mov'];
    $file_type = $_FILES['file']['type'];

    if (!in_array($file_type, $allowed_types)) {
        echo "Format file tidak didukung!";
        exit();
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        $stmt = $conn->prepare("INSERT INTO galeri (jenis, judul, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $jenis, $judul, $file_path);
        $stmt->execute();
        echo "File berhasil diunggah!";
    } else {
        echo "Gagal mengunggah file!";
    }
}

// Proses Hapus File
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $result = mysqli_query($conn, "SELECT file_path FROM galeri WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    if (file_exists($row['file_path'])) {
        unlink($row['file_path']); // Hapus file dari server
    }

    mysqli_query($conn, "DELETE FROM galeri WHERE id='$id'");
}

// Ambil Data Galeri
$result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
?>

<div class="container">
    <h1>Galeri Foto & Video</h1>

    <!-- Form Upload Foto/Video -->
    <form method="post" action="" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul File" required>
        <select name="jenis" required>
            <option value="foto">Foto</option>
            <option value="video">Video</option>
        </select>
        <input type="file" name="file" required>
        <button type="submit" name="upload">Upload</button>
    </form>

    <!-- Galeri Foto & Video -->
    <div class="galeri">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="item">
                <?php if ($row['jenis'] == 'foto') { ?>
                    <img src="<?= $row['file_path']; ?>" alt="<?= $row['judul']; ?>">
                <?php } else { ?>
                    <video controls>
                        <source src="<?= $row['file_path']; ?>" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                <?php } ?>
                <p><?= $row['judul']; ?></p>
                <a href="galeri.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </div>
        <?php } ?>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
form {
    display: flex;
    flex-direction: column;
    width: 300px;
    margin: 20px auto;
}
input, select, button {
    margin: 5px 0;
    padding: 10px;
}
.galeri {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.item {
    margin: 10px;
    text-align: center;
}
img, video {
    width: 250px;
    height: auto;
    border-radius: 10px;
}
</style>
