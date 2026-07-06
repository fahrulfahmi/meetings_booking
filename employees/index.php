<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM employees ORDER BY id DESC");

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/navbar.php';

?>

<div class="content">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Data Karyawan</h2>

<a href="tambah.php" class="btn btn-primary">
<i class="bi bi-plus-circle"></i> Tambah Karyawan
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

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th width="60">No</th>
<th>Nama</th>
<th>Departemen</th>
<th>Email</th>
<th>No HP</th>
<th width="170">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($data)) :

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama']; ?></td>

<td><?= $row['departemen']; ?></td>

<td><?= $row['email']; ?></td>

<td><?= $row['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus?')">

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

<?php include '../includes/footer.php'; ?>