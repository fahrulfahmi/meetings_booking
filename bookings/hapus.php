<?php

require_once '../auth/cek_login.php';
require_once '../config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");

header("Location: index.php?delete=1");
exit;