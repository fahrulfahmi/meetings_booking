<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

$rooms = mysqli_query($conn, "SELECT * FROM rooms WHERE status='Available' ORDER BY nama_ruangan ASC");

if ($_SESSION['role'] == 'admin') {

    $employees = mysqli_query($conn, "SELECT * FROM employees ORDER BY nama ASC");

} else {

    $employee_id = $_SESSION['employee_id'];

    $employees = mysqli_query($conn, "
        SELECT *
        FROM employees
        WHERE id='$employee_id'
        LIMIT 1
    ");

}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

    <div class="card shadow">

        <div class="card-header">

            <h4>Tambah Booking Meeting</h4>

        </div>

        <div class="card-body">

            <form action="simpan.php" method="POST">

                <div class="mb-3">

                    <label class="form-label">

                        Karyawan

                    </label>

                    <?php if($_SESSION['role']=="admin"): ?>

                        <select
                            name="employee_id"
                            class="form-select"
                            required>

                            <option value="">-- Pilih Karyawan --</option>

                            <?php while($emp=mysqli_fetch_assoc($employees)): ?>

                                <option value="<?= $emp['id']; ?>">

                                    <?= $emp['nama']; ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    <?php else:

                        $emp=mysqli_fetch_assoc($employees);

                    ?>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= $emp['nama']; ?>"
                            readonly>

                        <input
                            type="hidden"
                            name="employee_id"
                            value="<?= $emp['id']; ?>">

                    <?php endif; ?>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Ruangan

                    </label>

                    <select
                        name="room_id"
                        class="form-select"
                        required>

                        <option value="">-- Pilih Ruangan --</option>

                        <?php while($room=mysqli_fetch_assoc($rooms)): ?>

                            <option value="<?= $room['id']; ?>">

                                <?= $room['nama_ruangan']; ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label>Tanggal</label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label>Jam Mulai</label>

                            <input
                                type="time"
                                name="jam_mulai"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mb-3">

                            <label>Jam Selesai</label>

                            <input
                                type="time"
                                name="jam_selesai"
                                class="form-control"
                                required>

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label>Keperluan Meeting</label>

                    <textarea
                        name="keperluan"
                        class="form-control"
                        rows="4"
                        required></textarea>

                </div>

                <?php if($_SESSION['role']=="admin"): ?>

                    <div class="mb-3">

                        <label>Status</label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>

                        </select>

                    </div>

                <?php else: ?>

                    <input
                        type="hidden"
                        name="status"
                        value="Pending">

                <?php endif; ?>

                <button class="btn btn-primary">

                    Simpan Booking

                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>