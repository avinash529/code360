<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
    table td,
    table th {
        font-size: 12px;
    }

    .card {
        margin-top: 20px;
    }

    .export-buttons {
        margin-bottom: 10px;
    }

    .image-cell img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .navbar .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
        /* remove the default 0.125rem gap */
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= site_url('dashboard') ?>">MyApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('dashboard') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reports</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('payment'); ?>">Payment</a>
                </li>
                <?php $user_id = $this->session->userdata('user_id'); ?>

                <?php $user_id = $this->session->userdata('user_id'); ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="transactionDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transactions
                    </a>
                    <div class="dropdown-menu" aria-labelledby="transactionDropdown">
                        <?php if ($user_id == -1): ?>
                        <a class="dropdown-item" href="<?= site_url('transaction/add_class') ?>">Add Class</a>
                        <a class="dropdown-item" href="<?= site_url('transaction/add_subclass') ?>">Add Subclass</a>
                        <a class="dropdown-item" href="<?= site_url('transaction/add_product') ?>">Add Product</a>
                        <?php else: ?>
                        <a class="dropdown-item" href="<?= site_url('transaction/add_product') ?>">Add Product</a>
                        <?php endif; ?>
                    </div>
                </li>




            </ul>

            <span class="navbar-text text-light mr-3">
                Logged in as: <?= $this->session->userdata('username') ?>
            </span>
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>