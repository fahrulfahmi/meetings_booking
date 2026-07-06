<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

$id = $_GET['id'];

$booking = mysqli_query($conn, "SELECT * FROM bookings WHERE id='$id'");
$data = mysqli_fetch_assoc($booking);

$employees = mysqli_query($conn, "SELECT * FROM employees ORDER BY nama ASC");
$rooms = mysqli_query($conn, "SELECT * FROM rooms ORDER BY nama_ruangan ASC");

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

    <div class="card shadow">

        <div class="card-header">
            <h4>Edit Booking Meeting</h4>
        </div>

        <div class="card-body">

            <form action="simpan.php" method="POST">

                <input type="hidden" name="id" value="<?= $data['id']; ?>">

                <div class="mb-3">

                    <label class="form-label">
                        Karyawan
                    </label>

                    <select
                        name="employee_id"
                        class="form-select"
                        required>

                        <?php while($emp=mysqli_fetch_assoc($employees)) : ?>

                            <option
                                value="<?= $emp['id']; ?>"
                                <?= $emp['id']==$data['employee_id'] ? 'selected' : ''; ?>>

                                <?= $emp['nama']; ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Ruangan
                    </label>

                    <select
                        name="room_id"
                        class="form-select"
                        required>

                        <?php while($room=mysqli_fetch_assoc($rooms)) : ?>

                            <option
                                value="<?= $room['id']; ?>"
                                <?= $room['id']==$data['room_id'] ? 'selected' : ''; ?>>

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
                                value="<?= $data['tanggal']; ?>"
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
                                value="<?= substr($data['jam_mulai'],0,5); ?>"
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
                                value="<?= substr($data['jam_selesai'],0,5); ?>"
                                class="form-control"
                                required>

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label>Keperluan</label>

                    <textarea
                        name="keperluan"
                        class="form-control"
                        rows="4"
                        required><?= $data['keperluan']; ?></textarea>

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="Pending" <?= $data['status']=="Pending" ? "selected" : ""; ?>>
                            Pending
                        </option>

                        <option value="Approved" <?= $data['status']=="Approved" ? "selected" : ""; ?>>
                            Approved
                        </option>

                        <option value="Rejected" <?= $data['status']=="Rejected" ? "selected" : ""; ?>>
                            Rejected
                        </option>

                    </select>

                </div>

                <button class="btn btn-warning">

                    Update Booking

                </button>

                <a href="index.php" class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>