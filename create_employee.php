<?php

require_once 'config/koneksi.php';

// Data akun karyawan
$nama = "Budi Santoso";
$email = "budi@company.com";
$password = password_hash("123456", PASSWORD_DEFAULT);
$role = "employee";
$employee_id = 1;

// Cek apakah email sudah ada
$cek = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

if (mysqli_num_rows($cek) > 0) {
    echo "Email sudah terdaftar!";
    exit;
}

$sql = "INSERT INTO users (
    nama,
    email,
    password,
    role,
    employee_id
) VALUES (
    '$nama',
    '$email',
    '$password',
    '$role',
    '$employee_id'
)";

if (mysqli_query($conn, $sql)) {
    echo "Akun karyawan berhasil dibuat.";
} else {
    echo "Gagal: " . mysqli_error($conn);
}