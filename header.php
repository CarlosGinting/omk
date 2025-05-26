<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMK Rayon Delitua</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.png" alt="Logo OMK Rayon Delitua">
    </div>
    <h2 class="title">OMK Rayon Delitua</h2>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="anggota.php">Anggota</a>
        <a href="kegiatan.php">Kegiatan</a>
        <a href="berita.php">Berita</a>
        <a href="galeri.php">Galeri</a>
        <a href="forum.php">Forum</a>
        <a href="kontak.php">Kontak</a>
    </nav>
</header>

<style>
header {
    background: #001f3f; /* Warna biru navy */
    padding: 10px;
    color: white;
    display: flex;
    align-items: center; /* Menyusun elemen dalam satu baris */
    justify-content: space-between;
}

.logo img {
    width: 50px; /* Atur ukuran logo agar tidak terlalu besar */
    height: auto;
}

.logo, .title {
    display: flex;
    align-items: center;
}

.title {
    margin-left: 10px; /* Beri jarak antara logo dan teks */
    font-size: 24px;
}

nav {
    display: flex;
    gap: 15px;
}

nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

nav a:hover {
    text-decoration: underline;
    color: #00aaff; /* Biru lebih terang saat hover */
}
</style>
</body>
</html>
