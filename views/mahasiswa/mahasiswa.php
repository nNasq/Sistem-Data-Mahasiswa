<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-normal mb-0" style="color: var(--nova-heading);">Data Mahasiswa</h3>
    <a href="index.php?page=mahasiswacreate" class="btn btn-primary px-3">Tambah Mahasiswa</a>
</div>

<div class="nova-card overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">No</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT m.nim, m.nama_lengkap, m.angkatan, p.nama_prodi 
                          FROM mahasiswa m 
                          INNER JOIN prodi p ON m.id_prodi = p.id_prodi 
                          ORDER BY m.nim ASC";
                $result = mysqli_query($conn, $query);
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td class="text-center text-muted"><?= $no++ ?></td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-1"><?= $row['nim'] ?></span></td>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td><?= $row['nama_prodi'] ?></td>
                        <td><?= $row['angkatan'] ?></td>
                        <td class="text-center align-middle text-nowrap">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="index.php?page=mahasiswaDetail&nim=<?= $row['nim']; ?>" class="btn btn-success btn-sm text-white fw-medium">
                                    Detail
                                </a>
                                <a href="index.php?page=mahasiswaEdit&nim=<?= $row['nim']; ?>" class="btn btn-warning btn-sm fw-medium">
                                    Edit
                                </a>
                                <a href="controller/mahasiswa.php?aksi=hapus_mhs&nim=<?= $row['nim']; ?>" class="btn btn-danger btn-sm fw-medium">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>