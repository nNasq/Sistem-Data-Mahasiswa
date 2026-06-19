<?php 
require_once __DIR__ . '/../../config/koneksi.php'; 

$id_prodi = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM prodi WHERE id_prodi = '$id_prodi'");
$data = mysqli_fetch_assoc($query);
?>

<div class="nova-card overflow-hidden" style="max-width: 600px;">
    <div class="card-body p-4">
        <h4 class="fw-bold text-dark mb-4" style="color: var(--nova-heading) !important;">Edit Program Studi</h4>

        <form action="controllers/prodiController.php?aksi=edit" method="POST">
            
            <input type="hidden" name="id_prodi" value="<?= $data['id_prodi'] ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Nama Program Studi</label>
                <input type="text" name="nama_prodi" class="form-control" value="<?= $data['nama_prodi'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Fakultas</label>
                <input type="text" name="fakultas" class="form-control" value="<?= $data['fakultas'] ?>" required>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update Data</button>
                <a href="index.php?page=prodi" class="btn btn-secondary px-4">Batal</a>
            </div>
            
        </form>
    </div>
</div>