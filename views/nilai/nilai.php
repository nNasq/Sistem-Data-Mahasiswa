<?php require_once __DIR__ . '/../../config/koneksi.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-normal mb-0" style="color: var(--nova-heading);">Daftar Nilai Mahasiswa</h3>
    <a href="index.php?page=nilaiCreate" class="btn btn-primary px-3">Tambah Nilai</a>
</div>

<div class="nova-card overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 60px;">No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th class="text-center" style="width: 80px;">SKS</th>
                    <th class="text-center" style="width: 120px;">Nilai Angka</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT n.id_nilai, m.nim, m.nama_lengkap, mk.nama_mk, mk.sks, n.nilai_angka 
                          FROM nilai n 
                          INNER JOIN mahasiswa m ON n.nim = m.nim 
                          INNER JOIN matakuliah mk ON n.kode_mk = mk.kode_mk 
                          ORDER BY m.nama_lengkap ASC, mk.nama_mk ASC";
                $result = mysqli_query($conn, $query);

                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td class="text-center text-muted"><?= $no++ ?></td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-1"><?= $row['nim'] ?></span></td>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td><?= $row['nama_mk'] ?></td>
                        <td class="text-center"><?= $row['sks'] ?></td>
                        <td class="text-center">
                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-1" style="font-size: 0.9rem;">
                                <?= number_format($row['nilai_angka'], 2) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="index.php?page=nilaiEdit&id=<?= $row['id_nilai'] ?>"
                                    class="btn btn-warning btn-sm fw-medium px-3">Edit</a>

                                <a href="controllers/nilaiController.php?aksi=hapus&id=<?= $row['id_nilai'] ?>"
                                    class="btn btn-danger btn-sm px-3"
                                    onclick="return confirm('Yakin menghapus nilai ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>