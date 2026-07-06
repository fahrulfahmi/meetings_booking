<?php

require_once '../config/koneksi.php';

$id = $_POST['id'] ?? '';

$nama = $_POST['nama_ruangan'];
$kapasitas = $_POST['kapasitas'];
$lokasi = $_POST['lokasi'];
$fasilitas = $_POST['fasilitas'];
$status = $_POST['status'];

if($id == ""){

    mysqli_query($conn,"
    INSERT INTO rooms
    (
        nama_ruangan,
        kapasitas,
        lokasi,
        fasilitas,
        status
    )
    VALUES
    (
        '$nama',
        '$kapasitas',
        '$lokasi',
        '$fasilitas',
        '$status'
    )
    ");

}else{

    mysqli_query($conn,"
    UPDATE rooms SET

    nama_ruangan='$nama',

    kapasitas='$kapasitas',

    lokasi='$lokasi',

    fasilitas='$fasilitas',

    status='$status'

    WHERE id='$id'
    ");

}

header("Location:index.php?success=1");