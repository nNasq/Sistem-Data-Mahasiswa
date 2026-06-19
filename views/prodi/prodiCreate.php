<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="card border-0 shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        
        <h4 class="fw-bold text-dark mb-4">Tambah Program Studi</h4>

        <form action="controllers/prodiController.php?aksi=tambah" method="POST">
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nama Program Studi</label>
                <input type="text" name="nama_prodi" class="form-control" required placeholder="Contoh: Teknologi Informasi">
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Fakultas</label>
                <input type="text" name="fakultas" class="form-control" required placeholder="Contoh: Vokasi">
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="index.php?page=prodi" class="btn btn-secondary px-4">Batal</a>
            </div>
            
        </form>
    </div>
</div>