<?php 
include 'header.php'; 
include 'koneksi.php'; 

// Proses Tambah Kegiatan
if (isset($_POST['tambah'])) {
    $nama_kegiatan = mysqli_real_escape_string($conn, $_POST['nama_kegiatan']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    // Pastikan folder uploads tersedia
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Cek apakah file diunggah
    if (!empty($_FILES["foto"]["name"])) {
        $file_name = basename($_FILES["foto"]["name"]);
        $file_tmp = $_FILES["foto"]["tmp_name"];
        $file_size = $_FILES["foto"]["size"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array("jpg", "jpeg", "png", "gif");

        // Validasi jenis file
        if (in_array($file_ext, $allowed_ext) && $file_size < 2 * 1024 * 1024) { // Maks 2MB
            $new_file_name = uniqid() . "." . $file_ext;
            $upload_path = $target_dir . $new_file_name;
            
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Simpan data ke database
                $query = "INSERT INTO kegiatan (nama_kegiatan, deskripsi, foto) VALUES ('$nama_kegiatan', '$deskripsi', '$upload_path')";
                mysqli_query($conn, $query);
                echo "<script>alert('Kegiatan berhasil ditambahkan!'); window.location='kegiatan.php';</script>";
            } else {
                echo "<script>alert('Gagal mengunggah gambar!');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak didukung atau ukuran terlalu besar!');</script>";
        }
    } else {
        echo "<script>alert('Harap unggah foto kegiatan!');</script>";
    }
}


// Proses Hapus Kegiatan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $result = mysqli_query($conn, "SELECT foto FROM kegiatan WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
    
    if (file_exists($row['foto'])) {
        unlink($row['foto']); // Hapus file foto dari server
    }
    
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id='$id'");
}

// Ambil Data Kegiatan
$result = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY id DESC");
?>

<div class="container">
    <h1>Kegiatan & Event</h1>

    <!-- Form Tambah Kegiatan -->
    <form method="post" action="" enctype="multipart/form-data">
        <input type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" required>
        <textarea name="deskripsi" placeholder="Deskripsi Kegiatan" required></textarea>
        <input type="file" name="foto" required>
        <button type="submit" name="tambah">Tambah Kegiatan</button>
    </form>

    <!-- Tabel Data Kegiatan -->
    <table border="1">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Kegiatan</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><img src="<?= $row['foto']; ?>" width="100"></td>
            <td><?= $row['nama_kegiatan']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td>
                <a href="edit_kegiatan.php?id=<?= $row['id']; ?>">Edit</a>
                <a href="kegiatan.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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
img {
    border-radius: 10px;
}
</style>
