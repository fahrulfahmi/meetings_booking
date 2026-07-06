<?php

require_once '../config/koneksi.php';

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM employees WHERE id='$id'");

header("Location:index.php?delete=1");