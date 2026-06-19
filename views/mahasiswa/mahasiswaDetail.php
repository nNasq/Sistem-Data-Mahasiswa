<?php require_once __DIR__ . '/../../config/koneksi.php';

$nim = isset($_GET['nim']) ? $_GET['nim'] : '';

if (empty($nim)) {
    echo "<script>alert('NIM tidak ditemukan!'); window.location='index.php?page=mahasiswa';</script>";
    exit;
}

$q_mhs = "SELECT m.*, p.nama_prodi, p.fakultas 
          FROM mahasiswa m 
          LEFT JOIN prodi p ON m.id_prodi = p.id_prodi 
          WHERE m.nim = '$nim'";
$r_mhs = mysqli_query($conn, $q_mhs);
$mhs = mysqli_fetch_assoc($r_mhs);

if (!$mhs) {
    echo "<script>alert('Data mahasiswa tidak ada di database!'); window.location='index.php?page=mahasiswa';</script>";
    exit;
}

$q_nilai = "SELECT n.nilai_angka, mk.kode_mk, mk.nama_mk, mk.sks 
            FROM nilai n 
            INNER JOIN matakuliah mk ON n.kode_mk = mk.kode_mk 
            WHERE n.nim = '$nim' 
            ORDER BY mk.nama_mk ASC";
$r_nilai = mysqli_query($conn, $q_nilai);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1" style="color: var(--nova-heading) !important;">Detail Mahasiswa</h2>
        <p class="text-secondary mb-0">Informasi profil lengkap dan riwayat akademik</p>
    </div>
    <a href="index.php?page=mahasiswa" class="btn btn-dark border shadow-sm fw-medium">
        &larr; Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="nova-card overflow-hidden h-100">
            <div class="p-4 border-bottom border-light bg-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <?= strtoupper(substr($mhs['nama_lengkap'], 0, 1)) ?>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-bold text-dark"><?= $mhs['nama_lengkap'] ?></h5>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-1">
                            NIM: <?= $mhs['nim'] ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.05em;">Informasi Akademik</h6>
                <table class="table table-borderless table-sm mb-4">
                    <tr>
                        <td class="text-muted w-50">Program Studi</td>
                        <td class="fw-medium text-dark"><?= $mhs['nama_prodi'] ? $mhs['nama_prodi'] : '-' ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Fakultas</td>
                        <td class="fw-medium text-dark"><?= $mhs['fakultas'] ? $mhs['fakultas'] : '-' ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tahun Angkatan</td>
                        <td class="fw-medium text-dark"><?= $mhs['angkatan'] ?></td>
                    </tr>
                </table>

                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.05em;">Informasi Kontak</h6>
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted w-50">Email</td>
                        <td class="fw-medium text-dark">
                            <?= !empty($mhs['email']) ? $mhs['email'] : '<span class="badge bg-danger bg-opacity-10 text-danger rounded-1">Belum diatur</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor HP</td>
                        <td class="fw-medium text-dark">
                            <?= !empty($mhs['no_hp']) ? $mhs['no_hp'] : '<span class="badge bg-danger bg-opacity-10 text-danger rounded-1">Belum diatur</span>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted align-top">Alamat Domisili</td>
                        <td class="fw-medium text-dark">
                            <?= !empty($mhs['alamat']) ? nl2br($mhs['alamat']) : '<span class="badge bg-danger bg-opacity-10 text-danger rounded-1">Belum diatur</span>' ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="nova-card overflow-hidden h-100">
            <div class="p-4 border-bottom border-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold" style="color: var(--nova-heading);">Riwayat Akademik (Transkrip)</h6>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="20%">Kode MK</th>
                            <th width="50%">Mata Kuliah</th>
                            <th class="text-center" width="15%">SKS</th>
                            <th class="text-center" width="15%">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (mysqli_num_rows($r_nilai) > 0) :
                            $total_sks = 0;
                            while($nilai = mysqli_fetch_assoc($r_nilai)): 
                                $total_sks += $nilai['sks'];
                        ?>
                        <tr>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-1">
                                    <?= $nilai['kode_mk'] ?>
                                </span>
                            </td>
                            <td class="fw-medium text-dark"><?= $nilai['nama_mk'] ?></td>
                            <td class="text-center text-muted"><?= $nilai['sks'] ?></td>
                            <td class="text-center">
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-1" style="font-size: 0.9rem;">
                                    <?= number_format($nilai['nilai_angka'], 2) ?>
                                </span>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                        else: 
                        ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4" style="font-size: 0.9rem;">
                                Belum ada data nilai mata kuliah untuk mahasiswa ini.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    
                    <?php if (mysqli_num_rows($r_nilai) > 0) : ?>
                    <tfoot class="bg-light border-top">
                        <tr>
                            <td colspan="2" class="text-end fw-bold text-dark py-3">Total SKS Diambil:</td>
                            <td class="text-center fw-bold text-primary py-3 fs-6"><?= $total_sks ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>