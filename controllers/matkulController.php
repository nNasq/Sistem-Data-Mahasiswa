<?php
require_once __DIR__ . '/../config/koneksi.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'tambah':
        $kode_mk = trim($_POST['kode_mk']);
        $nama_mk = trim($_POST['nama_mk']);
        $sks = trim($_POST['sks']);

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

        $cek_kode = mysqli_query($conn, "SELECT kode_mk FROM matakuliah WHERE kode_mk = '$kode_mk'");
        if (mysqli_num_rows($cek_kode) > 0) {
            echo "<script>
                    alert('Gagal: Kode MK \"$kode_mk\" sudah terdaftar!');
                    window.history.back();
                  </script>";
            exit;
        }

        $cek_nama = mysqli_query($conn, "SELECT nama_mk FROM matakuliah WHERE nama_mk = '$nama_mk'");
        if (mysqli_num_rows($cek_nama) > 0) {
            echo "<script>
                    alert('Gagal: Nama Mata Kuliah \"$nama_mk\" sudah ada di sistem!');
                    window.history.back();
                  </script>";
            exit;
        }

        $query = "INSERT INTO matakuliah (kode_mk, nama_mk, sks) VALUES ('$kode_mk', '$nama_mk', '$sks')";

        mysqli_query($conn, $query);
        header("Location: ../index.php?page=matkul");
        break;

    case 'edit':
        $kode_mk = trim($_POST['kode_mk']);
        $nama_mk = trim($_POST['nama_mk']);
        $sks = trim($_POST['sks']);

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

        $cek_nama = mysqli_query($conn, "SELECT nama_mk FROM matakuliah WHERE nama_mk = '$nama_mk' AND kode_mk != '$kode_mk'");
        if (mysqli_num_rows($cek_nama) > 0) {
            echo "<script>
                    alert('Gagal: Nama Mata Kuliah \"$nama_mk\" sudah digunakan oleh Kode MK lain!');
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
        // Memperbaiki typo URL sebelumnya dari page=matakuliah menjadi page=matkul
        header("Location: ../index.php?page=matkul"); 
        break;
}
?>