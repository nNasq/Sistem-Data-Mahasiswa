<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="card border-0 shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">

        <h4 class="fw-bold text-dark mb-4">Input Nilai Baru</h4>

        <form action="controllers/nilaiController.php?aksi=tambah" method="POST">

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Mahasiswa</label>
                <select name="nim" class="form-select" required>
                    <option value="">-- Pilih Mahasiswa --</option>
                    <?php
                    $mhs = mysqli_query($conn, "SELECT nim, nama_lengkap FROM mahasiswa ORDER BY nama_lengkap ASC");
                    while ($m = mysqli_fetch_assoc($mhs)) {
                        echo "<option value='{$m['nim']}'>{$m['nim']} - {$m['nama_lengkap']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Mata Kuliah</label>
                <select name="kode_mk" class="form-select" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    <?php
                    $mk = mysqli_query($conn, "SELECT kode_mk, nama_mk FROM matakuliah");
                    while ($k = mysqli_fetch_assoc($mk)) {
                        echo "<option value='{$k['kode_mk']}'>{$k['kode_mk']} - {$k['nama_mk']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nilai Angka (0 - 100)</label>
                <input type="number" step="0.01" name="nilai_angka" class="form-control" min="0" max="100" required>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="index.php?page=nilai" class="btn btn-secondary px-4">Batal</a>
            </div>

        </form>
    </div>
</div>