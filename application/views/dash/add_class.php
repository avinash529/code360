<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Add Class Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-fit">
            <div class="bg-indigo-600 px-6 py-4">
                <h5 class="text-white font-semibold flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Add New Class
                </h5>
            </div>
            <div class="p-6">
                <form action="<?= site_url('transaction/save_class') ?>" method="post">
                    <div class="mb-4">
                        <label for="class_name" class="block text-sm font-medium text-slate-700 mb-1">Class Name</label>
                        <input type="text" name="class_name" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" value="<?= set_value('class_name'); ?>" required placeholder="e.g. Electronics">
                    </div>
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Save Class
                    </button>
                </form>
            </div>
        </div>

        <!-- Class List -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
                <h5 class="text-slate-700 font-semibold flex items-center">
                    <i class="fas fa-list mr-2"></i> Class List
                </h5>
            </div>
            <div class="p-6">
                <table id="classTable" class="w-full text-left border-collapse">
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
                            <td class="font-medium text-slate-900"><?= htmlspecialchars($class->class_name, ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <div class="flex space-x-2">
                                    <button type="button" class="bg-amber-100 text-amber-700 hover:bg-amber-200 px-3 py-1 rounded text-sm font-medium transition-colors edit-btn"
                                        data-id="<?= $class->id ?>"
                                        data-name="<?= htmlspecialchars($class->class_name, ENT_QUOTES, 'UTF-8') ?>">
                                        Edit
                                    </button>

                                    <a href="<?= site_url('transaction/delete_class/' . $class->id) ?>"
                                        class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded text-sm font-medium transition-colors" onclick="return confirm('Are you sure?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-slate-500 py-4">No classes found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal (Tailwind) -->
<div id="editModal" class="hidden fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" id="modalBackdrop"></div>
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
            <form method="post" action="<?= site_url('transaction/update_class') ?>">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="flex items-center justify-between">
                         <h3 class="text-lg font-semibold leading-6 text-slate-900">Edit Class</h3>
                         <button type="button" class="close-modal text-slate-400 hover:text-slate-500 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                         </button>
                    </div>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <input type="hidden" name="class_id" id="edit_class_id">
                    <div class="mb-4">
                        <label for="edit_class_name" class="block text-sm font-medium text-slate-700 mb-1">Class Name</label>
                        <input type="text" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" id="edit_class_name" name="class_name" required>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-100">
                    <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition-colors">Update</button>
                    <button type="button" class="close-modal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('#classTable')) {
        $('#classTable').DataTable({ dom: 'frtip' });
    }

    // Show Modal
    $('.edit-btn').on('click', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#edit_class_id').val(id);
        $('#edit_class_name').val(name);
        
        $('#editModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    });
    
    // Hide Modal
    $('.close-modal, #modalBackdrop').click(function() {
        $('#editModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    });
});
</script>
