<?php

require_once '../config/koneksi.php';

$room_id     = $_POST['room_id'];
$tanggal     = $_POST['tanggal'];
$jam_mulai   = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

$query = mysqli_query($conn, "
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

if(mysqli_num_rows($query) > 0){

    echo json_encode([
        "status" => false,
        "message" => "Ruangan sudah dibooking."
    ]);

}else{

    echo json_encode([
        "status" => true,
        "message" => "Ruangan tersedia."
    ]);

}