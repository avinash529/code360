<!DOCTYPE html>
<html>

<head>
    <title>Manage Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
</head>

<body>

    <div class="container mt-4">

        <?php if (validation_errors()): ?>
        <div class="alert alert-danger"><?= validation_errors(); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Add New Class
            </div>
            <div class="card-body">
                <form action="<?= site_url('transaction/save_class') ?>" method="post">
                    <div class="form-group">
                        <label for="class_name">Class Name</label>
                        <input type="text" name="class_name" class="form-control"
                            value="<?= set_value('class_name'); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Class</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                Class List
            </div>
            <div class="card-body">
                <table id="classTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Class Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($classes)) : ?>
                        <?php foreach ($classes as $index => $class): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($class->class_name, ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning edit-btn"
                                    data-id="<?= $class->id ?>"
                                    data-name="<?= htmlspecialchars($class->class_name, ENT_QUOTES, 'UTF-8') ?>"
                                    data-toggle="modal" data-target="#editModal">
                                    Edit
                                </button>

                                <a href="<?= site_url('transaction/delete_class/' . $class->id) ?>"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No classes found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="<?= site_url('transaction/update_class') ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Class</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="class_id" id="edit_class_id">
                        <div class="form-group">
                            <label for="edit_class_name">Class Name</label>
                            <input type="text" class="form-control" id="edit_class_name" name="class_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JS scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#classTable').DataTable();

        $('.edit-btn').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#edit_class_id').val(id);
            $('#edit_class_name').val(name);
        });
    });
    </script>

</body>

</html>