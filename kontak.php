<?php include 'header.php'; ?>
<div class="container">
    <h1>Buku Tamu & Kontak</h1>
    <form action="#" method="post">
        <input type="text" name="nama" placeholder="Nama Anda" required>
        <input type="email" name="email" placeholder="Email Anda" required>
        <textarea name="pesan" placeholder="Pesan Anda" required></textarea>
        <button type="submit">Kirim</button>
    </form>
</div>
<?php include 'footer.php'; ?>

<style>
input, textarea {
    width: 90%;
    padding: 10px;
    margin: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
button {
    padding: 10px;
    background: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
}
button:hover {
    background: #0056b3;
}
</style>
