<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="card border-0 shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">

        <h4 class="fw-bold text-dark mb-4">Tambah Mata Kuliah</h4>

        <form action="controllers/matkulController.php?aksi=tambah" method="POST">

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Kode Mata Kuliah</label>
                <input type="text" name="kode_mk" class="form-control" required placeholder="Contoh: MK01">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" required placeholder="Contoh: Basis Data">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Jumlah SKS</label>
                <input type="number" name="sks" class="form-control" required min="1" max="6">
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="index.php?page=matkul" class="btn btn-secondary px-4">Batal</a>
            </div>

        </form>
    </div>
</div>