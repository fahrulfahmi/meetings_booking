<?php

$host = "localhost";
$user = "root";
$password = "root";
$database = "meeting_booking";
$port = 8889;

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database,
    $port
);

if (!$conn) {
    die("Koneksi database gagal : " . mysqli_connect_error());
}