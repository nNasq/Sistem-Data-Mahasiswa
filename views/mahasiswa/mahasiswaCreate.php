<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="nova-card overflow-hidden" style="max-width: 800px;">
    <div class="card-body p-4">

        <h4 class="fw-bold text-dark mb-4" style="color: var(--nova-heading) !important;">Tambah Data Mahasiswa</h4>

        <form action="controllers/mahasiswaController.php?aksi=tambah_mhs" method="POST">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">NIM</label>
                    <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM (Angka)" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap Mahasiswa" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Program Studi</label>
                    <select name="id_prodi" class="form-select" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <?php
                        $prodi = mysqli_query($conn, "SELECT * FROM prodi");
                        while ($p = mysqli_fetch_assoc($prodi)) {
                            echo "<option value='{$p['id_prodi']}'>{$p['nama_prodi']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Angkatan</label>
                    <input type="number" name="angkatan" class="form-control" placeholder="Contoh: 2025" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold text-secondary">Alamat Domisili</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..."></textarea>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4 fw-medium" style="background-color: var(--nova-primary-hover);">Simpan Data</button>
                <a href="index.php?page=mahasiswa" class="btn btn-dark border shadow-sm px-4 fw-medium">Batal</a>
            </div>

        </form>
    </div>
</div>