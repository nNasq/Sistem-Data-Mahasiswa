<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-normal mb-0" style="color: var(--nova-heading);">Data Prodi</h3>
    <a href="index.php?page=prodiCreate" class="btn btn-primary px-3">Tambah Prodi</a>
</div>

<div class="nova-card overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">No</th>
                    <th>Nama Program Studi</th>
                    <th>Fakultas</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM prodi ORDER BY id_prodi ASC";
                $result = mysqli_query($conn, $query);

                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td class="text-center text-muted"><?= $no++ ?></td>
                        <td><?= $row['nama_prodi'] ?></td>
                        <td><?= $row['fakultas'] ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="index.php?page=prodiEdit&id=<?= $row['id_prodi'] ?>"
                                    class="btn btn-warning btn-sm fw-medium px-3">Edit</a>

                                <a href="controllers/prodiController.php?aksi=hapus&id=<?= $row['id_prodi'] ?>"
                                    class="btn btn-danger btn-sm px-3"
                                    onclick="return confirm('Yakin ingin menghapus prodi ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>