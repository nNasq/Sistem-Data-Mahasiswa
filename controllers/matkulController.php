<?php
require_once __DIR__ . '/../config/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'tambah':
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];

        if (empty($kode_mk) || empty($nama_mk) || empty($sks)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        if (!is_numeric($sks)) {
            echo "<script>
                    alert('Gagal: SKS harus berupa angka numerik!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "INSERT INTO matakuliah (kode_mk, nama_mk, sks) VALUES ('$kode_mk', '$nama_mk', '$sks')";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=matkul");
        break;

    case 'edit':
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];

        if (empty($kode_mk) || empty($nama_mk) || empty($sks)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        if (!is_numeric($sks)) {
            echo "<script>
                    alert('Gagal: SKS harus berupa angka numerik!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "UPDATE matakuliah SET nama_mk = '$nama_mk', sks = '$sks' WHERE kode_mk = '$kode_mk'";
        mysqli_query($conn, $query);

        header("Location: ../index.php?page=matkul");
        break;

    case 'hapus':
        $kode_mk = $_GET['kode'];
        $query = "DELETE FROM matakuliah WHERE kode_mk = '$kode_mk'";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=matakuliah");
        break;
}
