<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm navbar-custom">

<div class="container-fluid">

    <span class="navbar-brand fw-bold">

        Meeting Booking

    </span>

    <div class="ms-auto">

        <span class="me-3">

            <i class="bi bi-person-circle"></i>

            <?= $_SESSION['nama']; ?>

        </span>

        <a
        href="../auth/logout.php"
        class="btn btn-danger btn-sm">

            Logout

        </a>

    </div>

</div>

</nav>