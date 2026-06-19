<?php
require_once __DIR__ . '/../config/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'tambah':
        $nama_prodi = $_POST['nama_prodi'];
        $fakultas = $_POST['fakultas'];

        if (empty($nama_prodi) || empty($fakultas)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "INSERT INTO prodi (nama_prodi, fakultas) VALUES ('$nama_prodi', '$fakultas')";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=prodi");
        break;

    case 'edit':
        $id_prodi = $_POST['id_prodi'];
        $nama_prodi = $_POST['nama_prodi'];
        $fakultas = $_POST['fakultas'];

        if (empty($nama_prodi) || empty($fakultas)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "UPDATE prodi SET nama_prodi = '$nama_prodi', fakultas = '$fakultas' WHERE id_prodi = '$id_prodi'";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=prodi");
        break;

    case 'hapus':
        $id_prodi = $_GET['id'];
        $query = "DELETE FROM prodi WHERE id_prodi = '$id_prodi'";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=prodi");
        break;
}
