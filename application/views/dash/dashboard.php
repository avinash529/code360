<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h4 class="text-2xl font-bold text-slate-800">User Management</h4>
        <!-- Optional: Add an "Add User" button here if needed -->
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline"><?= $this->session->flashdata('success') ?></span>
    </div>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
            <h5 class="text-slate-700 font-semibold">Registered Users</h5>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="userTable">
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
                        <!-- DataTables will populate this -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal (Tailwind Custom Implementation) -->
<div id="editUserModal" class="hidden fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" id="modalBackdrop"></div>

    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
            
            <!-- Modal Header -->
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold leading-6 text-slate-900" id="modal-title">Edit User</h3>
                    <button type="button" class="close-modal text-slate-400 hover:text-slate-500 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form id="editUserForm">
                <div class="px-4 py-5 sm:p-6 space-y-4">
                    <input type="hidden" name="id" id="userId">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Profile Image</label>
                        <div class="flex items-center space-x-4">
                            <img id="previewImage" src="" alt="Current Image" class="h-16 w-16 rounded-full object-cover border border-slate-200 bg-slate-50">
                            <label class="cursor-pointer bg-white border border-slate-300 rounded-md py-2 px-3 flex items-center shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                                <span>Change</span>
                                <input type="file" name="image" class="sr-only" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="userName" class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                        <input type="text" id="userName" name="name" required class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-slate-50">
                    </div>

                    <div>
                        <label for="userEmail" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" id="userEmail" name="email" required class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-slate-50">
                    </div>

                    <div>
                        <label for="userUsername" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                        <input type="text" id="userUsername" name="username" required class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-slate-50">
                    </div>

                    <div>
                        <label for="userPhone" class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                        <input type="text" id="userPhone" name="phone" required class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2 bg-slate-50">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-100">
                    <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition-colors">Save Changes</button>
                    <button type="button" class="close-modal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                className: 'image-cell',
                render: function(data, type, row) {
                    return data ? '<img src="' + '<?= base_url('uploads/') ?>' + data + '" class="h-10 w-10 rounded-full object-cover border border-slate-200">' : ''; // Enhanced image rendering
                }
            },
            { data: 'name', className: 'font-medium text-slate-900' },
            { data: 'email', className: 'text-slate-500' },
            { data: 'username', className: 'text-slate-500' },
            { data: 'phone', className: 'text-slate-500' },
            {
                data: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    // Assuming 'actions' returns HTML buttons, we might need to style them or relies on the server returning basic buttons.
                    // If the server returns plain HTML, it might contain Bootstrap classes like 'btn btn-primary'.
                    // We can try to replace them via JS or just target them in CSS if we can't change the controller.
                    // For now, let's assume valid HTML is returned.
                    return data; 
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel mr-2"></i>Export to Excel',
                className: 'bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition-colors border-0 text-sm font-medium',
                title: 'User Data',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf mr-2"></i>Export to PDF',
                className: 'bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition-colors border-0 text-sm font-medium ml-2',
                title: 'User Data',
                exportOptions: {
                    columns: [1, 2, 3, 4]
                }
            }
        ],
        language: {
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>'
            }
        },
        drawCallback: function() {
            // Add Tailwind classes to DataTables elements after drawing
            $('.dataTables_wrapper .dt-buttons button').removeClass('dt-button'); // Remove default DataTables button classes if problematic
        }
    });

    // Handle Edit Modal
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
                $('#previewImage').attr('src', '<?= base_url('uploads/') ?>' + data.image);
                
                // Show Tailwind Modal
                $('#editUserModal').removeClass('hidden');
                $('body').addClass('overflow-hidden'); // Prevent background scrolling
            }
        });
    });

    // Close Modal Logic
    $('.close-modal, #modalBackdrop').click(function() {
        $('#editUserModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    });

    // Prevent modal close when clicking inside the modal content
    $('#editUserModal .relative').click(function(e) {
        e.stopPropagation();
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
                // Hide Tailwind Modal
                 $('#editUserModal').addClass('hidden');
                 $('body').removeClass('overflow-hidden');
                 userTable.ajax.reload();
            }
        });
    });
});
</script>
</body>

</html>
