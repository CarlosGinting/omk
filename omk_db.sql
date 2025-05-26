CREATE DATABASE omk_db;

USE omk_db;

CREATE TABLE anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telepon VARCHAR(15),
    alamat TEXT
    
);
CREATE TABLE kegiatan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kegiatan VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    foto VARCHAR(255) NOT NULL
);
CREATE TABLE galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis ENUM('foto', 'video') NOT NULL,
    judul VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL
);
CREATE TABLE forum (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE komentar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    forum_id INT NOT NULL,
    nama VARCHAR(100) NOT NULL,
    isi TEXT NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (forum_id) REFERENCES forum(id) ON DELETE CASCADE
);


