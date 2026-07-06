<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM rooms WHERE id='$id'");

$room = mysqli_fetch_assoc($query);

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

<div class="card shadow">

<div class="card-header">

<h4>Edit Ruangan</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $room['id']; ?>">

<div class="mb-3">

<label>

Nama Ruangan

</label>

<input
type="text"
name="nama_ruangan"
value="<?= $room['nama_ruangan']; ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>

Kapasitas

</label>

<input
type="number"
name="kapasitas"
value="<?= $room['kapasitas']; ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>

Lokasi

</label>

<input
type="text"
name="lokasi"
value="<?= $room['lokasi']; ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>

Fasilitas

</label>

<textarea
name="fasilitas"
rows="3"
class="form-control"><?= $room['fasilitas']; ?></textarea>

</div>

<div class="mb-3">

<label>

Status

</label>

<select
name="status"
class="form-select">

<option
value="Available"
<?= $room['status']=="Available" ? "selected" : ""; ?>>

Available

</option>

<option
value="Maintenance"
<?= $room['status']=="Maintenance" ? "selected" : ""; ?>>

Maintenance

</option>

</select>

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

<?php

include '../includes/footer.php';

?>