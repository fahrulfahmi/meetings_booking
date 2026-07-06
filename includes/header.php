<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meeting Booking System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f8f9fa;
        }

        .sidebar{

            width:260px;
            height:100vh;

            position:fixed;

            left:0;
            top:0;

            background:#0d6efd;

            color:white;

        }

        .sidebar a{

            color:white;

            text-decoration:none;

            display:block;

            padding:14px 20px;

            transition:.3s;

        }

        .sidebar a:hover{

            background:rgba(255,255,255,.15);

        }

        .content{

            margin-left:260px;

            padding:30px;

        }

        .navbar-custom{

            margin-left:260px;

        }

        .card-dashboard{

            border:none;

            border-radius:15px;

        }

    </style>

</head>

<body>