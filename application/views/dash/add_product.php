<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div id="react-root"></div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Add Product Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-fit">
            <div class="bg-indigo-600 px-6 py-4">
                <h5 class="text-white font-semibold flex items-center">
                    <i class="fas fa-box-open mr-2"></i> Add New Product
                </h5>
            </div>
            <div class="p-6">
                <form action="<?= site_url('transaction/save_product') ?>" method="post" class="space-y-4">
                    <div>
                        <label for="class_id" class="block text-sm font-medium text-slate-700 mb-1">Product Class</label>
                        <select name="class_id" id="class_id" class="premium-select block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required>
                            <option value="">Select Class</option>
                            
                            <?php foreach ($classes as $class): ?>
                            <option value="<?= $class->id ?>"><?= $class->class_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="subclass_id" class="block text-sm font-medium text-slate-700 mb-1">Product Subclass</label>
                        <select name="subclass_id" id="subclass_id" class="premium-select block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required disabled>
                            <option value="">Select Class First</option>
                        </select>
                    </div>

                    <div>
                        <label for="product_name" class="block text-sm font-medium text-slate-700 mb-1">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-slate-700 mb-1">Amount (₹)</label>
                        <input type="number" name="amount" id="amount" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required>
                    </div>

                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                        Save Product
                    </button>
                </form>
            </div>
        </div>

        <!-- Product List Table -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
                <h5 class="text-slate-700 font-semibold flex items-center">
                    <i class="fas fa-list mr-2"></i> Product List
                </h5>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="productTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Subclass</th>
                                <th>Product Name</th>
                                <th>Amount (₹)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $index => $product): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="text-slate-600"><?= $product->class_name ?></td>
                                <td class="text-slate-600"><?= $product->subclass_name ?></td>
                                <td class="font-medium text-slate-900"><?= $product->product_name ?></td>
                                <td class="text-slate-900 font-bold"><?= number_format($product->amount, 2) ?></td>

                                <td>
                                    <div class="flex space-x-2">
                                        <button class="bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-3 py-1 rounded text-sm font-medium transition-colors editBtn" data-id="<?= $product->id ?>">Edit</button>
                                        <button class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded text-sm font-medium transition-colors deleteBtn" data-id="<?= $product->id ?>">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-slate-500 py-4">No products found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Edit Modal (Tailwind) -->
<div id="editProductModal" class="hidden fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" id="modalBackdrop"></div>
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200">
            <form id="editProductForm">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                    <div class="flex items-center justify-between">
                         <h3 class="text-lg font-semibold leading-6 text-slate-900">Edit Product</h3>
                         <button type="button" class="close-modal text-slate-400 hover:text-slate-500 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                         </button>
                    </div>
                </div>
                <div class="px-4 py-5 sm:p-6 space-y-4">
                    <input type="hidden" name="id" id="edit_id">
                    <div>
                        <label for="edit_class_id" class="block text-sm font-medium text-slate-700 mb-1">Class</label>
                        <select name="class_id" id="edit_class_id" class="premium-select block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required></select>
                    </div>
                    <div>
                        <label for="edit_subclass_id" class="block text-sm font-medium text-slate-700 mb-1">Subclass</label>
                        <select name="subclass_id" id="edit_subclass_id" class="premium-select block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required></select>
                    </div>
                    <div>
                        <label for="edit_product_name" class="block text-sm font-medium text-slate-700 mb-1">Product Name</label>
                        <input type="text" name="product_name" id="edit_product_name" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required>
                    </div>
                    <div>
                        <label for="edit_amount" class="block text-sm font-medium text-slate-700 mb-1">Amount</label>
                        <input type="number" name="amount" id="edit_amount" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2.5 bg-slate-50" required>
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

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
$(function() {
    if (!$.fn.DataTable.isDataTable('#productTable')) {
        $('#productTable').DataTable({ dom: 'frtip' });
    }

    $('.editBtn').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '<?= site_url("transaction/get_product_by_id") ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#edit_id').val(data.id);
                $('#edit_product_name').val(data.product_name);
                $('#edit_amount').val(data.amount);

                $('#edit_class_id').empty();
                $.each(data.classes, function(i, cls) {
                    $('#edit_class_id').append(
                        `<option value="${cls.id}" ${cls.id == data.class_id ? 'selected' : ''}>${cls.class_name}</option>`
                    );
                });

                $('#edit_subclass_id').empty().append('<option value="">Select Subclass</option>');
                $.each(data.subclasses, function(i, sub) {
                    if (sub.class_id == data.class_id) {
                        $('#edit_subclass_id').append(
                            `<option value="${sub.id}" ${sub.id == data.subclass_id ? 'selected' : ''}>${sub.subclass_name}</option>`
                        );
                    }
                });

                // Show Tailwind Modal
                $('#editProductModal').removeClass('hidden');
                $('body').addClass('overflow-hidden');
            },
            error: function() {
                alert('Failed to load product data.');
            }
        });
    });
    
    // Hide Modal
    $('.close-modal, #modalBackdrop').click(function() {
        $('#editProductModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    });

    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?= site_url("transaction/update_product") ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Hide Tailwind Modal
                $('#editProductModal').addClass('hidden');
                $('body').removeClass('overflow-hidden');
                location.reload();
            },
            error: function() {
                alert('Update failed. Please try again.');
            }
        });
    });

    $('.deleteBtn').on('click', function() {
        const id = $(this).data('id');
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: '<?= site_url("transaction/delete_product_ajax") ?>/' + id,
                type: 'GET',
                success: function() {
                    location.reload();
                },
                error: function() {
                    alert('Failed to delete product.');
                }
            });
        }
    });

    // Dependent Dropdown for Add Product
    $('#class_id').on('change', function() {
        const classId = $(this).val();
        const subclassSelect = $('#subclass_id');
        
        subclassSelect.empty().append('<option value="">Loading...</option>').prop('disabled', true);
        
        if (classId) {
            $.ajax({
                url: '<?= site_url("transaction/get_subclasses_by_class_ajax") ?>/' + classId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    subclassSelect.empty().append('<option value="">Select Subclass</option>');
                    $.each(data, function(i, sub) {
                        subclassSelect.append(`<option value="${sub.id}">${sub.subclass_name}</option>`);
                    });
                    subclassSelect.prop('disabled', false);
                },
                error: function() {
                    subclassSelect.empty().append('<option value="">Error loading</option>');
                }
            });
        } else {
            subclassSelect.empty().append('<option value="">Select Class First</option>');
        }
    });

    // Dependent Dropdown for Edit Modal
    $('#edit_class_id').on('change', function() {
        const classId = $(this).val();
        const subclassSelect = $('#edit_subclass_id');
        
        subclassSelect.empty().append('<option value="">Loading...</option>');
        
        if (classId) {
            $.ajax({
                url: '<?= site_url("transaction/get_subclasses_by_class_ajax") ?>/' + classId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    subclassSelect.empty().append('<option value="">Select Subclass</option>');
                    $.each(data, function(i, sub) {
                        subclassSelect.append(`<option value="${sub.id}">${sub.subclass_name}</option>`);
                    });
                },
                error: function() {
                    subclassSelect.empty().append('<option value="">Error loading</option>');
                }
            });
        } else {
            subclassSelect.empty().append('<option value="">Select Class First</option>');
        }
    });
});
</script>
