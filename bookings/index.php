<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

if ($_SESSION['role'] == 'admin') {

    $query = mysqli_query($conn, "
        SELECT
            bookings.*,
            employees.nama AS nama_karyawan,
            rooms.nama_ruangan
        FROM bookings
        INNER JOIN employees
            ON bookings.employee_id = employees.id
        INNER JOIN rooms
            ON bookings.room_id = rooms.id
        ORDER BY bookings.id DESC
    ");

} else {

$employeeId = $_SESSION['employee_id'] ?? 0;
    $query = mysqli_query($conn, "
        SELECT
            bookings.*,
            employees.nama AS nama_karyawan,
            rooms.nama_ruangan
        FROM bookings
        INNER JOIN employees
            ON bookings.employee_id = employees.id
        INNER JOIN rooms
            ON bookings.room_id = rooms.id
        WHERE bookings.employee_id = '$employeeId'
        ORDER BY bookings.id DESC
    ");

}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Data Booking Meeting</h2>

        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Booking
        </a>

    </div>

    <?php if(isset($_GET['success'])) : ?>

        <div class="alert alert-success">

            Data booking berhasil disimpan.

        </div>

    <?php endif; ?>

    <?php if(isset($_GET['delete'])) : ?>

        <div class="alert alert-danger">

            Data booking berhasil dihapus.

        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                <tr>

                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keperluan</th>
                    <th>Status</th>

                    <?php if($_SESSION['role']=="admin"): ?>

                    <th width="250">

                        Aksi

                    </th>

                    <?php endif; ?>

                </tr>

                </thead>

                <tbody>

                <?php

                $no=1;

                while($row=mysqli_fetch_assoc($query)):

                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= htmlspecialchars($row['nama_karyawan']); ?></td>

                    <td><?= htmlspecialchars($row['nama_ruangan']); ?></td>

                    <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

                    <td>

                        <?= substr($row['jam_mulai'],0,5); ?>

                        -

                        <?= substr($row['jam_selesai'],0,5); ?>

                    </td>

                    <td><?= htmlspecialchars($row['keperluan']); ?></td>

                    <td>

                        <?php

                        switch($row['status']){

                            case "Approved":

                                echo '<span class="badge bg-success">Approved</span>';

                                break;

                            case "Rejected":

                                echo '<span class="badge bg-danger">Rejected</span>';

                                break;

                            default:

                                echo '<span class="badge bg-warning text-dark">Pending</span>';

                        }

                        ?>

                    </td>

                    <?php if($_SESSION['role']=="admin"): ?>

                    <td>

                        <?php if($row['status']=="Pending"): ?>

                            <a
                                href="approve.php?id=<?= $row['id']; ?>"
                                class="btn btn-success btn-sm">

                                Approve

                            </a>

                            <a
                                href="reject.php?id=<?= $row['id']; ?>"
                                class="btn btn-secondary btn-sm">

                                Reject

                            </a>

                        <?php endif; ?>

                        <a
                            href="edit.php?id=<?= $row['id']; ?>"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <a
                            href="hapus.php?id=<?= $row['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus booking ini?')">

                            Hapus

                        </a>

                    </td>

                    <?php endif; ?>

                </tr>

                <?php endwhile; ?>

                <?php if(mysqli_num_rows($query)==0): ?>

                <tr>

                    <td colspan="<?= $_SESSION['role']=="admin" ? 8 : 7; ?>" class="text-center">

                        Belum ada data booking.

                    </td>

                </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>