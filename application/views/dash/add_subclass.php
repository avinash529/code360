<!DOCTYPE html>
<html>

<head>
    <title>Manage Sub Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container mt-4">

        <!-- Flash messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Add New Sub Class</div>
            <div class="card-body">
                <form method="post" action="<?= site_url('transaction/save_subclass') ?>">
                    <div class="form-group">
                        <label for="class_id">Select Class</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">-- Select Class --</option>
                            <?php foreach ($classes as $class): ?>
                                <option value="<?= $class->id ?>"><?= $class->class_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subclass_name">Sub Class Name</label>
                        <input type="text" name="subclass_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Sub Class</button>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="card-header bg-dark text-white">Sub Class List</div>
            <div class="card-body">
                <table id="subclassTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sub Class Name</th>
                            <th>Parent Class</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($subclasses)) : ?>
                            <?php foreach ($subclasses as $index => $subclass): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($subclass->subclass_name, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($subclass->class_name, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning edit-btn"
                                            data-id="<?= $subclass->id ?>"
                                            data-name="<?= htmlspecialchars($subclass->subclass_name, ENT_QUOTES, 'UTF-8') ?>"
                                            data-classid="<?= $subclass->class_id ?>"
                                            data-toggle="modal" data-target="#editModal">Edit</button>

                                        <a href="<?= site_url('transaction/delete_subclass/' . $subclass->id) ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">No subclasses found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="<?= site_url('transaction/update_subclass') ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Sub Class</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="subclass_id" id="edit_subclass_id">
                        <div class="form-group">
                            <label for="edit_class_id">Class</label>
                            <select name="class_id" id="edit_class_id" class="form-control" required>
                                <option value="">-- Select Class --</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class->id ?>"><?= $class->class_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_subclass_name">Sub Class Name</label>
                            <input type="text" name="subclass_name" id="edit_subclass_name" class="form-control"
                                required>
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

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#subclassTable').DataTable();

            $('.edit-btn').on('click', function () {
                $('#edit_subclass_id').val($(this).data('id'));
                $('#edit_subclass_name').val($(this).data('name'));
                $('#edit_class_id').val($(this).data('classid'));
            });
        });
    </script>
</body>
</html>
