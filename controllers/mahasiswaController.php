<?php
require_once __DIR__ . '/../config/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'tambah_mhs':
        $nim = trim($_POST['nim']);
        $nama = trim($_POST['nama_lengkap']);
        $id_prodi = trim($_POST['id_prodi']);
        $angkatan = trim($_POST['angkatan']);
        $email = trim($_POST['email'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        $no_hp = trim($_POST['no_hp'] ?? '');

        if (empty($nim) || empty($nama) || empty($id_prodi) || empty($angkatan) || empty($email) || empty($alamat) || empty($no_hp)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        if (!is_numeric($nim) || !is_numeric($no_hp) || !is_numeric($angkatan)) {
            echo "<script>
                    alert('Gagal: NIM dan Nomor HP harus berupa angka numerik!');
                    window.history.back();
                  </script>";
            exit;
        }

        $cek_nim = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
        if (mysqli_num_rows($cek_nim) > 0) {
            echo "<script>
                    alert('Gagal: NIM $nim sudah terdaftar di sistem! Silakan gunakan NIM lain.');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "INSERT INTO mahasiswa (nim, nama_lengkap, email, alamat, no_hp, id_prodi, angkatan) 
                  VALUES ('$nim', '$nama', '$email', '$alamat', '$no_hp', '$id_prodi', '$angkatan')";
        mysqli_query($conn, $query);

        header("Location: /sdm/index.php?page=mahasiswa&pesan=tambah");
        exit;
        break;

    case 'edit':
        $nim = trim($_POST['nim']);
        $nama_lengkap = trim($_POST['nama_lengkap']);
        $id_prodi = trim($_POST['id_prodi']);
        $angkatan = trim($_POST['angkatan']);

        $email = trim($_POST['email'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        $no_hp = trim($_POST['no_hp'] ?? '');

        if (empty($nim) || empty($nama_lengkap) || empty($id_prodi) || empty($angkatan) || empty($email) || empty($alamat) || empty($no_hp)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        if (!is_numeric($nim) || !is_numeric($no_hp) || !is_numeric($angkatan)) {
            echo "<script>
                    alert('Gagal: NIM harus berupa angka numerik!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "UPDATE mahasiswa SET 
                  nama_lengkap = '$nama_lengkap', 
                  email = '$email',
                  alamat = '$alamat',
                  no_hp = '$no_hp',
                  id_prodi = '$id_prodi', 
                  angkatan = '$angkatan' 
                  WHERE nim = '$nim'";

        mysqli_query($conn, $query);

        header("Location: ../index.php?page=mahasiswa&pesan=edit");
        exit;
        break;

    case 'hapus_mhs':
        $nim = $_GET['nim'];

        $query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
        mysqli_query($conn, $query);

        header("Location: /sdm/index.php?page=mahasiswa&pesan=hapus");
        exit;
        break;
}