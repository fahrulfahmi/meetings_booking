<?php

require_once '../config/koneksi.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_POST['id'] ?? '';

$nama = trim($_POST['nama']);
$departemen = trim($_POST['departemen']);
$email = trim($_POST['email']);
$no_hp = trim($_POST['no_hp']);
$password = $_POST['password'] ?? '';

try {

    mysqli_begin_transaction($conn);

    if ($id == '') {

        // Cek email
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            throw new Exception("Email sudah digunakan.");
        }

        // Insert employee
        $stmt = $conn->prepare("
            INSERT INTO employees
            (
                nama,
                departemen,
                email,
                no_hp
            )
            VALUES
            (?,?,?,?)
        ");

        $stmt->bind_param(
            "ssss",
            $nama,
            $departemen,
            $email,
            $no_hp
        );

        $stmt->execute();

        $employee_id = $conn->insert_id;

        // Insert user login
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $role = "employee";

        $stmt = $conn->prepare("
            INSERT INTO users
            (
                nama,
                email,
                password,
                role,
                employee_id
            )
            VALUES
            (?,?,?,?,?)
        ");

        $stmt->bind_param(
            "ssssi",
            $nama,
            $email,
            $hash,
            $role,
            $employee_id
        );

        $stmt->execute();

    } else {

        // Update employee
        $stmt = $conn->prepare("
            UPDATE employees
            SET
                nama=?,
                departemen=?,
                email=?,
                no_hp=?
            WHERE id=?
        ");

        $stmt->bind_param(
            "ssssi",
            $nama,
            $departemen,
            $email,
            $no_hp,
            $id
        );

        $stmt->execute();

        // Apakah user sudah ada?
        $stmt = $conn->prepare("
            SELECT id
            FROM users
            WHERE employee_id=?
        ");

        $stmt->bind_param("i",$id);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows==0){

            // Employee lama belum punya akun login

            $hash=password_hash(
                $password != "" ? $password : "123456",
                PASSWORD_DEFAULT
            );

            $role="employee";

            $stmt=$conn->prepare("
                INSERT INTO users
                (
                    nama,
                    email,
                    password,
                    role,
                    employee_id
                )
                VALUES
                (?,?,?,?,?)
            ");

            $stmt->bind_param(
                "ssssi",
                $nama,
                $email,
                $hash,
                $role,
                $id
            );

            $stmt->execute();

        }else{

            if($password!=""){

                $hash=password_hash($password,PASSWORD_DEFAULT);

                $stmt=$conn->prepare("
                    UPDATE users
                    SET
                        nama=?,
                        email=?,
                        password=?
                    WHERE employee_id=?
                ");

                $stmt->bind_param(
                    "sssi",
                    $nama,
                    $email,
                    $hash,
                    $id
                );

            }else{

                $stmt=$conn->prepare("
                    UPDATE users
                    SET
                        nama=?,
                        email=?
                    WHERE employee_id=?
                ");

                $stmt->bind_param(
                    "ssi",
                    $nama,
                    $email,
                    $id
                );

            }

            $stmt->execute();

        }

    }

    mysqli_commit($conn);

    header("Location:index.php?success=1");
    exit;

} catch (Exception $e) {

    mysqli_rollback($conn);

    die(
        "<h3>Error</h3>" .
        $e->getMessage()
    );

}