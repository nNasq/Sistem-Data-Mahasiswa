<?php 
require_once __DIR__ . '/../../config/koneksi.php'; 

$kode_mk = $_GET['kode'];
$query = mysqli_query($conn, "SELECT * FROM matakuliah WHERE kode_mk = '$kode_mk'");
$data = mysqli_fetch_assoc($query);
?>

<div class="nova-card overflow-hidden" style="max-width: 600px;">
    <div class="card-body p-4">
        <h4 class="fw-bold text-dark mb-4" style="color: var(--nova-heading) !important;">Edit Mata Kuliah</h4>

        <form action="controllers/matkulController.php?aksi=edit" method="POST">
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Kode Mata Kuliah</label>
                <input type="text" name="kode_mk" class="form-control bg-light" value="<?= $data['kode_mk'] ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" value="<?= $data['nama_mk'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Jumlah SKS</label>
                <input type="number" name="sks" class="form-control" value="<?= $data['sks'] ?>" required min="1" max="6">
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update Data</button>
                <a href="index.php?page=matkul" class="btn btn-secondary px-4">Batal</a>
            </div>
            
        </form>
    </div>
</div>