<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

$totalRoom = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM rooms")
);

$totalEmployee = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM employees")
);

$totalBooking = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings")
);

$totalPending = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status='Pending'")
);

$bookingToday = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE tanggal = CURDATE()")
);

$recentBooking = mysqli_query($conn,"
SELECT
    bookings.*,
    employees.nama,
    rooms.nama_ruangan
FROM bookings
JOIN employees ON employees.id = bookings.employee_id
JOIN rooms ON rooms.id = bookings.room_id
ORDER BY bookings.created_at DESC
LIMIT 5
");

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-0">Dashboard</h2>
            <small class="text-muted">
                Selamat Datang, <?= $_SESSION['nama']; ?>
            </small>

        </div>

    </div>

    <div class="row g-4">

        <div class="col-md-3">

            <div class="card shadow border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Total Ruangan
                            </small>

                            <h2 class="fw-bold">
                                <?= $totalRoom['total']; ?>
                            </h2>

                        </div>

                        <i class="bi bi-door-open-fill text-primary fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Total Karyawan
                            </small>

                            <h2 class="fw-bold">
                                <?= $totalEmployee['total']; ?>
                            </h2>

                        </div>

                        <i class="bi bi-people-fill text-success fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Total Booking
                            </small>

                            <h2 class="fw-bold">
                                <?= $totalBooking['total']; ?>
                            </h2>

                        </div>

                        <i class="bi bi-calendar-check-fill text-warning fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">
                                Booking Hari Ini
                            </small>

                            <h2 class="fw-bold">
                                <?= $bookingToday['total']; ?>
                            </h2>

                        </div>

                        <i class="bi bi-calendar-date-fill text-danger fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Pending Approval

                    </h6>

                    <h1 class="text-warning">

                        <?= $totalPending['total']; ?>

                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <strong>

                        Booking Terbaru

                    </strong>

                </div>

                <div class="card-body">

                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th>Karyawan</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php if(mysqli_num_rows($recentBooking)>0): ?>

                            <?php while($row=mysqli_fetch_assoc($recentBooking)): ?>

                            <tr>

                                <td><?= $row['nama']; ?></td>

                                <td><?= $row['nama_ruangan']; ?></td>

                                <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

                                <td>

                                    <?php

                                    if($row['status']=="Approved"){

                                        echo '<span class="badge bg-success">Approved</span>';

                                    }elseif($row['status']=="Rejected"){

                                        echo '<span class="badge bg-danger">Rejected</span>';

                                    }else{

                                        echo '<span class="badge bg-warning text-dark">Pending</span>';

                                    }

                                    ?>

                                </td>

                            </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="4" class="text-center">

                                    Belum ada data booking.

                                </td>

                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>