<?php
require_once __DIR__ . '/../config/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'tambah':
        $nama_prodi = trim($_POST['nama_prodi']);
        $fakultas = trim($_POST['fakultas']);

        if (empty($nama_prodi) || empty($fakultas)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        $cek_prodi = mysqli_query($conn, "SELECT id_prodi FROM prodi WHERE nama_prodi = '$nama_prodi'");
        if (mysqli_num_rows($cek_prodi) > 0) {
            echo "<script>
                    alert('Gagal: Program Studi \"$nama_prodi\" sudah terdaftar di sistem!');
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
        $nama_prodi = trim($_POST['nama_prodi']);
        $fakultas = trim($_POST['fakultas']);

        if (empty($nama_prodi) || empty($fakultas)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        $cek_prodi = mysqli_query($conn, "SELECT id_prodi FROM prodi WHERE nama_prodi = '$nama_prodi' AND id_prodi != '$id_prodi'");
        if (mysqli_num_rows($cek_prodi) > 0) {
            echo "<script>
                    alert('Gagal: Nama Program Studi \"$nama_prodi\" sudah digunakan oleh ID lain!');
                    window.history.back();
                  </script>";
            exit;
        }
        // =========================================================

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
?>