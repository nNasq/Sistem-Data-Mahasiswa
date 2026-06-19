<?php
require_once __DIR__ . '/../config/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'tambah':
        $nim = $_POST['nim'];
        $kode_mk = $_POST['kode_mk'];
        $nilai_angka = $_POST['nilai_angka'];

        if (empty($nim) || empty($kode_mk) || empty($nilai_angka)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        if (!is_numeric($nilai_angka)) {
            echo "<script>
                    alert('Gagal: Nilai harus berupa angka numerik!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "INSERT INTO nilai (nim, kode_mk, nilai_angka) 
                  VALUES ('$nim', '$kode_mk', '$nilai_angka')";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=nilai");
        break;

    case 'edit':
        $id_nilai = $_POST['id_nilai'];
        $nim = $_POST['nim'];
        $kode_mk = $_POST['kode_mk'];
        $nilai_angka = $_POST['nilai_angka'];

        if (empty($nim) || empty($kode_mk) || empty($nilai_angka)) {
            echo "<script>
                    alert('Gagal: Semua kolom wajib diisi!');
                    window.history.back();
                  </script>";
            exit;
        }

        if (!is_numeric($nilai_angka)) {
            echo "<script>
                    alert('Gagal: Nilai harus berupa angka numerik!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "UPDATE nilai SET nim = '$nim', kode_mk = '$kode_mk', nilai_angka = '$nilai_angka' WHERE id_nilai = '$id_nilai'";
        mysqli_query($conn, $query);

        header("Location: ../index.php?page=nilai");
        break;

    case 'hapus':
        $id_nilai = $_GET['id'];
        $query = "DELETE FROM nilai WHERE id_nilai = '$id_nilai'";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=nilai");
        break;
}
