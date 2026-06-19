<?php
require_once __DIR__ . '/../config/koneksi.php';

$jml_mhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa"))['total'];
$jml_prodi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total_prodi FROM prodi"))['total_prodi'];
$jml_mk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total_mk FROM matakuliah"))['total_mk'];

$query_rata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT AVG(nilai_angka) as rata FROM nilai"));
$rata_nilai = $query_rata['rata'] ? $query_rata['rata'] : 0;

$query_max = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(nilai_angka) as tertinggi FROM nilai"));
$nilai_tertinggi = $query_max['tertinggi'] ? $query_max['tertinggi'] : 0;
?>

<div class="mb-4">
    <h2 class="fw-bold text-dark mb-1" style="color: var(--nova-heading) !important;">Sistem Data Mahasiswa</h2>
    <p class="text-secondary mb-0">Sistem Data Mahasiswa berbasis website, dimana anda bisa mengelola data mahasiswa dengan mudah</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100 border-start border-danger border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-2" style="font-size: 0.85rem;">Total Mahasiswa</h6>
                <h2 class="fw-bold mb-0 text-dark"><?= $jml_mhs; ?></h2>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100 border-start border-primary border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-2" style="font-size: 0.85rem;">Rata-rata Nilai</h6>
                <h2 class="fw-bold mb-0 text-dark"><?= number_format($rata_nilai, 2); ?></h2>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100 border-start border-success border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-2" style="font-size: 0.85rem;">Nilai Tertinggi</h6>
                <h2 class="fw-bold mb-0 text-dark"><?= number_format($nilai_tertinggi, 2); ?></h2>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100 border-start border-warning border-4">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-semibold mb-2" style="font-size: 0.85rem;">Prodi & Mata Kuliah</h6>
                <div class="d-flex align-items-baseline gap-2">
                    <h2 class="fw-bold mb-0 text-dark"><?= $jml_prodi; ?></h2>
                    <span class="text-muted fw-medium" style="font-size: 0.9rem;">Prodi</span>
                    <span class="text-muted fs-5">/</span>
                    <h2 class="fw-bold mb-0 text-dark"><?= $jml_mk; ?></h2>
                    <span class="text-muted fw-medium" style="font-size: 0.9rem;">MK</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-lg-7">
        <div class="nova-card overflow-hidden h-100">
            <div class="p-4 border-bottom border-light">
                <h6 class="mb-0 fw-bold" style="color: var(--nova-heading);">Top 5 Nilai Mahasiswa</h6>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th class="text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_top = "SELECT m.nama_lengkap, mk.nama_mk, n.nilai_angka 
                                  FROM nilai n 
                                  INNER JOIN mahasiswa m ON n.nim = m.nim 
                                  INNER JOIN matakuliah mk ON n.kode_mk = mk.kode_mk 
                                  ORDER BY n.nilai_angka DESC LIMIT 5";
                        $r_top = mysqli_query($conn, $q_top);

                        while ($row = mysqli_fetch_assoc($r_top)):
                        ?>
                            <tr>
                                <td class="fw-medium text-dark"><?= $row['nama_lengkap'] ?></td>
                                <td class="text-muted" style="font-size: 0.9rem;"><?= $row['nama_mk'] ?></td>
                                <td class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-1">
                                        <?= number_format($row['nilai_angka'], 2) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="nova-card overflow-hidden h-100">
            <div class="p-4 border-bottom border-light">
                <h6 class="mb-0 fw-bold" style="color: var(--nova-heading);">Distribusi Mahasiswa</h6>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Program Studi</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_dist = "SELECT p.nama_prodi, COUNT(m.nim) as total_mhs 
                                   FROM prodi p 
                                   LEFT JOIN mahasiswa m ON p.id_prodi = m.id_prodi 
                                   GROUP BY p.id_prodi 
                                   ORDER BY total_mhs DESC";
                        $r_dist = mysqli_query($conn, $q_dist);

                        while ($row = mysqli_fetch_assoc($r_dist)):
                        ?>
                            <tr>
                                <td class="fw-medium text-dark"><?= $row['nama_prodi'] ?></td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-success px-2 py-1 rounded-1">
                                        <?= $row['total_mhs'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>