<?php

if (!isset($_SESSION)) {
    session_start();
}

?>

<div class="sidebar">

    <h3 class="text-center py-4">

        <i class="bi bi-calendar-check"></i>

        Meeting Booking

    </h3>

    <!-- Dashboard -->

    <a href="../dashboard/">

        <i class="bi bi-speedometer2"></i>

        Dashboard

    </a>

    <?php if($_SESSION['role'] == 'admin') : ?>

        <!-- Menu Admin -->

        <a href="../rooms/">

            <i class="bi bi-door-open"></i>

            Data Ruangan

        </a>

        <a href="../employees/">

            <i class="bi bi-people"></i>

            Data Karyawan

        </a>

        <a href="../bookings/">

            <i class="bi bi-calendar-event"></i>

            Data Booking

        </a>

    <?php else : ?>

        <!-- Menu Employee -->

        <a href="../bookings/">

            <i class="bi bi-calendar-plus"></i>

            Booking Ruangan

        </a>

    <?php endif; ?>

    <hr class="text-white">

    <a href="../auth/logout.php">

        <i class="bi bi-box-arrow-right"></i>

        Logout

    </a>

</div>