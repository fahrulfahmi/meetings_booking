<?php

require_once '../auth/cek_login.php';

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

<div class="card shadow">

<div class="card-header">

<h4>Tambah Ruangan</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<div class="mb-3">

<label class="form-label">

Nama Ruangan

</label>

<input
type="text"
name="nama_ruangan"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Kapasitas

</label>

<input
type="number"
name="kapasitas"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Lokasi

</label>

<input
type="text"
name="lokasi"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Fasilitas

</label>

<textarea
name="fasilitas"
rows="3"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Status

</label>

<select
name="status"
class="form-select">

<option value="Available">

Available

</option>

<option value="Maintenance">

Maintenance

</option>

</select>

</div>

<button class="btn btn-primary">

Simpan

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