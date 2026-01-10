<div class="container mt-4">
    <h4>User List</h4>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            Registered Users
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="userTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="userId">

                    <div class="form-group">
                        <label for="image">Profile Image</label><br>
                        <img id="previewImage" src="" alt="Current Image"
                            style="height: 80px; margin-bottom: 10px;"><br>
                        <input type="file" name="image" class="form-control-file" accept="image/*">
                    </div>


                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="userUsername">Username</label>
                        <input type="text" class="form-control" id="userUsername" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="userPhone">Phone</label>
                        <input type="text" class="form-control" id="userPhone" name="phone" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables & Export Dependencies -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var userTable = $('#userTable').DataTable({
        ajax: '<?= site_url('dashboard/fetch_users') ?>',
        columns: [{
                data: 'image',
                className: 'image-cell'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'username'
            },
            {
                data: 'phone'
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false
            }
        ],
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                className: 'btn btn-success',
                title: 'User Data',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Export to PDF',
                className: 'btn btn-danger',
                title: 'User Data',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                }
            }
        ]
    });


    $('#exportExcel').click(function() {
        userTable.button('.buttons-excel').trigger();
    });

    $('#exportPDF').click(function() {
        userTable.button('.buttons-pdf').trigger();
    });


    $('#userTable').on('click', '[data-target="#editUserModal"]', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '<?= site_url('dashboard/get_user_data/') ?>' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#userId').val(data.id);
                $('#userName').val(data.name);
                $('#userEmail').val(data.email);
                $('#userUsername').val(data.username);
                $('#userPhone').val(data.phone);
                $('#previewImage').attr('src', '<?= base_url('uploads/') ?>' + data
                    .image);
                $('#editUserModal').modal('show');
            }
        });
    });

    $('#editUserForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: '<?= site_url('dashboard/update_user') ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#editUserModal').modal('hide');
                userTable.ajax.reload();
            }
        });
    });
});
</script>
</body>

</html>