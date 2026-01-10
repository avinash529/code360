<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4>User Registration</h4>
                    </div>
                    <div class="card-body">

                        <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>


                        <?= form_open_multipart('auth/register_action') ?>

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" required class="form-control" placeholder="Enter full name">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" required class="form-control"
                                placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" required class="form-control" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required class="form-control"
                                placeholder="Enter password">
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                        </div>

                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Register</button>
                        <?= form_close() ?>
                    </div>

                    <div class="card-footer text-center">
                        <small>Already have an account? <a href="<?= site_url('auth') ?>">Login here</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>