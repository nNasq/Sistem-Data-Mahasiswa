<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-normal mb-0" style="color: var(--nova-heading);">Data Matakuliah</h3>
    <a href="index.php?page=matkulCreate" class="btn btn-primary px-3">Tambah Matakuliah</a>
</div>

<div class="nova-card overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">No</th>
                    <th style="width: 120px;">Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th style="width: 100px;">SKS</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM matakuliah ORDER BY kode_mk ASC";
                $result = mysqli_query($conn, $query);

                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td class="text-center text-muted"><?= $no++ ?></td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-1">
                                <?= $row['kode_mk'] ?>
                            </span>
                        </td>
                        <td><?= $row['nama_mk'] ?></td>
                        <td><?= $row['sks'] ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="index.php?page=matkulEdit&kode=<?= $row['kode_mk'] ?>"
                                    class="btn btn-warning btn-sm fw-medium px-3">Edit</a>

                                <a href="controllers/matkulController.php?aksi=hapus&kode=<?= $row['kode_mk'] ?>"
                                    class="btn btn-danger btn-sm px-3"
                                    onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>