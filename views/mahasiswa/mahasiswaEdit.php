<?php 
require_once __DIR__ . '/../../config/koneksi.php'; 

$nim = isset($_GET['nim']) ? mysqli_real_escape_string($conn, $_GET['nim']) : '';

if (empty($nim)) {
    echo "<script>alert('NIM tidak ditemukan!'); window.location='index.php?page=mahasiswa';</script>";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data mahasiswa tidak ditemukan!'); window.location='index.php?page=mahasiswa';</script>";
    exit;
}
?>

<div class="nova-card overflow-hidden" style="max-width: 800px;">
    <div class="card-body p-4">
        <h4 class="fw-bold text-dark mb-4" style="color: var(--nova-heading) !important;">Edit Data Mahasiswa</h4>

        <form action="controllers/mahasiswaController.php?aksi=edit" method="POST">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">NIM</label>
                    <input type="text" name="nim" class="form-control bg-light" value="<?= $data['nim'] ?>" readonly>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap'] ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Program Studi</label>
                    <select name="id_prodi" class="form-select" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <?php
                        $prodi = mysqli_query($conn, "SELECT * FROM prodi");
                        while($p = mysqli_fetch_assoc($prodi)) {
                            $selected = ($p['id_prodi'] == $data['id_prodi']) ? 'selected' : '';
                            echo "<option value='{$p['id_prodi']}' $selected>{$p['nama_prodi']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Angkatan</label>
                    <input type="number" name="angkatan" class="form-control" value="<?= $data['angkatan'] ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $data['email'] ?? '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp'] ?? '' ?>">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold text-secondary">Alamat Domisili</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= $data['alamat'] ?? '' ?></textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4 fw-medium text-dark">Update Data</button>
                <a href="index.php?page=mahasiswa" class="btn btn-dark border shadow-sm px-4 fw-medium">Batal</a>
            </div>
            
        </form>
    </div>
</div>