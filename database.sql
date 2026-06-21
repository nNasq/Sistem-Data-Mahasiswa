CREATE DATABASE IF NOT EXISTS db_akademik;
USE db_akademik;

CREATE TABLE prodi (
    id_prodi INT AUTO_INCREMENT PRIMARY KEY,
    nama_prodi VARCHAR(100) NOT NULL,
    fakultas VARCHAR(100) NOT NULL
);

CREATE TABLE matakuliah (
    kode_mk VARCHAR(10) PRIMARY KEY,
    nama_mk VARCHAR(100) NOT NULL,
    sks INT NOT NULL
);

CREATE TABLE mahasiswa (
    nim VARCHAR(20) PRIMARY KEY,
    nama_lengkap VARCHAR(150) NOT NULL,
    id_prodi INT,
    angkatan INT,
    FOREIGN KEY (id_prodi) REFERENCES prodi (id_prodi) ON DELETE SET NULL
);

CREATE TABLE nilai (
    id_nilai INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20),
    kode_mk VARCHAR(10),
    nilai_angka DECIMAL(5, 2),
    FOREIGN KEY (nim) REFERENCES mahasiswa (nim) ON DELETE CASCADE,
    FOREIGN KEY (kode_mk) REFERENCES matakuliah (kode_mk) ON DELETE CASCADE
);

ALTER TABLE mahasiswa
    ADD COLUMN email VARCHAR(100) UNIQUE,
    ADD COLUMN alamat TEXT,
    ADD COLUMN no_hp VARCHAR(15);

-- Ini dilakukan jika memang dibutuhkan untuk menghapus tabel nilai.
-- DROP TABLE nilai;

INSERT INTO prodi (nama_prodi, fakultas)
VALUES
    ('Teknologi Informasi', 'Vokasi/Politeknik'),
    ('Teknik Sipil', 'Vokasi/Politeknik');

INSERT INTO matakuliah (kode_mk, nama_mk, sks)
VALUES
    ('MK01', 'Basis Data', 3),
    ('MK02', 'Pemrograman Web', 3);

INSERT INTO mahasiswa (nim, nama_lengkap, email, alamat, no_hp, id_prodi, angkatan)
VALUES
    ('254107060026', 'Hafizh Arrasyiid Syahbana', 'hafizh.as@gmail.com', 'Jl. Sigura-gura No. 5, Malang', '082140593821', 1, 2025),
    ('254107060027', 'Budi Santoso', 'budi@gmail.com', 'Jl. Suhat No. 10, Malang', '081234567890', 1, 2025),
    ('254107060028', 'Siti Aminah', 'siti@gmail.com', 'Jl. Dinoyo No. 12, Malang', '085648219384', 2, 2024);

INSERT INTO nilai (nim, kode_mk, nilai_angka)
VALUES
    ('254107060026', 'MK01', 90.50),
    ('254107060026', 'MK02', 88.00);

UPDATE matakuliah
SET nama_mk = 'Pemrograman Web Lanjut'
WHERE kode_mk = 'MK02';

DELETE FROM mahasiswa
WHERE nim = '254107060028';

SELECT * FROM mahasiswa;

SELECT COUNT(*) AS total_mahasiswa 
FROM mahasiswa;

SELECT * FROM nilai
ORDER BY nilai_angka DESC;

SELECT 
    m.nim,
    m.nama_lengkap,
    mk.nama_mk,
    n.nilai_angka
FROM nilai n
INNER JOIN mahasiswa m ON n.nim = m.nim
INNER JOIN matakuliah mk ON n.kode_mk = mk.kode_mk;