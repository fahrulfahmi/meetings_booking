<?php

require_once '../auth/cek_login.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard/");
    exit;
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

    <div class="card shadow">

        <div class="card-header">

            <h4>Tambah Karyawan</h4>

        </div>

        <div class="card-body">

            <form action="simpan.php" method="POST">

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">

                                Nama

                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">

                                Departemen

                            </label>

                            <input
                                type="text"
                                name="departemen"
                                class="form-control"
                                required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">

                                Email Login

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">

                                Nomor HP

                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                required>

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Password Login

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        minlength="6"
                        required>

                    <small class="text-muted">

                        Password minimal 6 karakter.

                    </small>

                </div>

                <button class="btn btn-primary">

                    Simpan Karyawan

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