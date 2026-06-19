<?php
require 'config/koneksi.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

include 'views/layouts/header.php';

if (file_exists("views/$page.php")) {
    include "views/$page.php";
} elseif (file_exists("views/mahasiswa/$page.php")) {
    include "views/mahasiswa/$page.php";
} elseif (file_exists("views/mahasiswa_detail/$page.php")) {
    include "views/mahasiswa_detail/$page.php";
} elseif (file_exists("views/matakuliah/$page.php")) {
    include "views/matakuliah/$page.php";
} elseif (file_exists("views/prodi/$page.php")) {
    include "views/prodi/$page.php";
} elseif (file_exists("views/nilai/$page.php")) {
    include "views/nilai/$page.php";
} else {
    echo "<div class='box-wrapper' style='text-align:center; padding: 40px;'>
            <h3>404 - Halaman Tidak Ditemukan</h3>
            <p>Pastikan URL dan nama file sudah benar.</p>
          </div>";
}

include 'views/layouts/footer.php';
