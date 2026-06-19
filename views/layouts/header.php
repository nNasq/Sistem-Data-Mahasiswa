<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="d-flex wrapper-main">

        <div class="sidebar d-flex flex-column" id="sidebar">
            <div class="brand-container d-flex align-items-center p-4">
                <svg class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--nova-primary-hover);">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="fs-5 fw-bold" style="color: var(--nova-heading);">Akademik</span>
            </div>

            <div class="nova-nav-label">Dashboards</div>
            <div class="nav flex-column mb-3">
                <a href="index.php?page=dashboard" class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?>">Main</a>
            </div>

            <div class="nova-nav-label">Resources</div>
            <div class="nav flex-column mb-auto gap-1">
                <a href="index.php?page=mahasiswa" class="nav-link <?= ($page == 'mahasiswa') ? 'active' : '' ?>">Mahasiswa</a>
                <a href="index.php?page=prodi" class="nav-link <?= ($page == 'prodi') ? 'active' : '' ?>">Prodi</a>
                <a href="index.php?page=matkul" class="nav-link <?= ($page == 'matkul') ? 'active' : '' ?>">Matakuliah</a>
                <a href="index.php?page=nilai" class="nav-link <?= ($page == 'nilai') ? 'active' : '' ?>">Nilai</a>
            </div>
        </div>

        <div class="main-content flex-grow-1 w-100">

            <div class="header">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-link text-muted p-0 text-decoration-none" id="toggleBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    <?php
                    $halaman_list = ['mahasiswa', 'prodi', 'matkul', 'nilai'];

                    if (in_array($page, $halaman_list)):
                    ?>
                        <div class="header-search position-relative d-none d-md-block">
                            <svg class="position-absolute text-muted" style="left: 12px; top: 10px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" id="searchInput" placeholder="Tekan / untuk mencari" autocomplete="off">
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="content-body px-4 py-3">