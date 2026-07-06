<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../dashboard/");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
employees.*,
users.email,
users.id AS user_id
FROM employees
LEFT JOIN users
ON users.employee_id = employees.id
WHERE employees.id='$id'
");

$row = mysqli_fetch_assoc($query);

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

<div class="card shadow">

<div class="card-header">

<h4>Edit Karyawan</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<input type="hidden" name="id" value="<?= $row['id']; ?>">

<input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label>Nama</label>

<input
type="text"
name="nama"
value="<?= $row['nama']; ?>"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label>Departemen</label>

<input
type="text"
name="departemen"
value="<?= $row['departemen']; ?>"
class="form-control"
required>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label>Email Login</label>

<input
type="email"
name="email"
value="<?= $row['email']; ?>"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label>No HP</label>

<input
type="text"
name="no_hp"
value="<?= $row['no_hp']; ?>"
class="form-control"
required>

</div>

</div>

</div>

<div class="mb-3">

<label>Password Baru</label>

<input
type="password"
name="password"
class="form-control">

<small class="text-muted">

Kosongkan jika password tidak ingin diubah.

</small>

</div>

<button class="btn btn-warning">

Update

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