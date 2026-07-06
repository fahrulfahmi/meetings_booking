<?php

require_once '../config/koneksi.php';

$id = $_POST['id'] ?? '';

$employee_id = $_POST['employee_id'];
$room_id = $_POST['room_id'];
$tanggal = $_POST['tanggal'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$keperluan = $_POST['keperluan'];
$status = $_POST['status'];

if($jam_mulai >= $jam_selesai){

    echo "<script>
        alert('Jam selesai harus lebih besar dari jam mulai.');
        history.back();
    </script>";

    exit;
}

if($id==""){

    $cek = mysqli_query($conn,"
    SELECT *
    FROM bookings
    WHERE room_id='$room_id'
    AND tanggal='$tanggal'
    AND (
        ('$jam_mulai' < jam_selesai)
        AND
        ('$jam_selesai' > jam_mulai)
    )
    ");

}else{

    $cek = mysqli_query($conn,"
    SELECT *
    FROM bookings
    WHERE room_id='$room_id'
    AND tanggal='$tanggal'
    AND id != '$id'
    AND (
        ('$jam_mulai' < jam_selesai)
        AND
        ('$jam_selesai' > jam_mulai)
    )
    ");

}

if(mysqli_num_rows($cek)>0){

    echo "<script>
        alert('Ruangan sudah dibooking pada jam tersebut.');
        history.back();
    </script>";

    exit;
}

if($id==""){

    mysqli_query($conn,"
    INSERT INTO bookings
    (
    employee_id,
    room_id,
    tanggal,
    jam_mulai,
    jam_selesai,
    keperluan,
    status
    )
    VALUES
    (
    '$employee_id',
    '$room_id',
    '$tanggal',
    '$jam_mulai',
    '$jam_selesai',
    '$keperluan',
    '$status'
    )
    ");

}else{

    mysqli_query($conn,"
    UPDATE bookings SET

    employee_id='$employee_id',

    room_id='$room_id',

    tanggal='$tanggal',

    jam_mulai='$jam_mulai',

    jam_selesai='$jam_selesai',

    keperluan='$keperluan',

    status='$status'

    WHERE id='$id'
    ");

}

header("Location:index.php?success=1");
exit;