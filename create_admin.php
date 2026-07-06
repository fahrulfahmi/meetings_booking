<?php

include 'config/koneksi.php';

$nama = "Administrator";
$email = "admin@meeting.com";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$sql = "INSERT INTO users(nama,email,password,role)
VALUES('$nama','$email','$password','admin')";

if(mysqli_query($conn,$sql)){
    echo "Admin berhasil dibuat";
}else{
    echo mysqli_error($conn);
}