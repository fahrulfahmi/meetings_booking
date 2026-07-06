<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM rooms ORDER BY id DESC");

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Ruangan</h2>

        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Ruangan
        </a>
    </div>

    <?php if(isset($_GET['success'])) : ?>

        <div class="alert alert-success">
            Data berhasil disimpan.
        </div>

    <?php endif; ?>

    <?php if(isset($_GET['delete'])) : ?>

        <div class="alert alert-danger">
            Data berhasil dihapus.
        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th width="60">No</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Lokasi</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $no = 1;

                while($row = mysqli_fetch_assoc($data)) :

                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $row['nama_ruangan']; ?></td>

                    <td><?= $row['kapasitas']; ?> Orang</td>

                    <td><?= $row['lokasi']; ?></td>

                    <td><?= $row['fasilitas']; ?></td>

                    <td>

                        <?php if($row['status']=="Available") : ?>

                            <span class="badge bg-success">
                                Available
                            </span>

                        <?php else : ?>

                            <span class="badge bg-danger">
                                Maintenance
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <a
                        href="edit.php?id=<?= $row['id']; ?>"
                        class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <a
                        href="hapus.php?id=<?= $row['id']; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">

                            Hapus

                        </a>

                    </td>

                </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

include '../includes/footer.php';

?>