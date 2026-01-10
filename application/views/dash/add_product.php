<div class="container mt-4">

    <!-- Flash messages -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>
<div id="react-root"></div>

    <!-- Add Product Form -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Add New Product</div>
        <div class="card-body">
            <form action="<?= site_url('transaction/save_product') ?>" method="post">
                <div class="form-group">
                    <label for="class_id">Product Class</label>
                    <select name="class_id" id="class_id" class="form-control" required>
                        <option value="">Select Class</option>
                        <?php foreach ($classes as $class): ?>
                        <option value="<?= $class->id ?>"><?= $class->class_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subclass_id">Product Subclass</label>
                    <select name="subclass_id" id="subclass_id" class="form-control" required>
                        <option value="">Select Subclass</option>
                        <?php foreach ($subclasses as $sub): ?>
                        <option value="<?= $sub->id ?>"><?= $sub->subclass_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount (₹)</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Save Product</button>
            </form>
        </div>
    </div>

    <!-- Product List Table -->
    <div class="card">
        <div class="card-header bg-dark text-white">Product List</div>
        <div class="card-body">
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Subclass</th>
                        <th>Product Name</th>
                        <th>Amount (₹)</th>
                        <th>Actions</th> <!-- NEW COLUMN -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $index => $product): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $product->class_name ?></td>
                        <td><?= $product->subclass_name ?></td>
                        <td><?= $product->product_name ?></td>
                        <td><?= number_format($product->amount, 2) ?></td>

                        <td>
                            <button class="btn btn-sm btn-primary editBtn" data-id="<?= $product->id ?>">Edit</button>
                            <button class="btn btn-sm btn-danger deleteBtn"
                                data-id="<?= $product->id ?>">Delete</button>
                        </td>


                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>
<!-- Edit Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editProductForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_class_id">Class</label>
                        <select name="class_id" id="edit_class_id" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="edit_subclass_id">Subclass</label>
                        <select name="subclass_id" id="edit_subclass_id" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="edit_product_name">Product Name</label>
                        <input type="text" name="product_name" id="edit_product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_amount">Amount</label>
                        <input type="number" name="amount" id="edit_amount" class="form-control" required>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>


<script>
$(function() {
    $('#productTable').DataTable();


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


                $('#edit_subclass_id').empty();
                $.each(data.subclasses, function(i, sub) {
                    $('#edit_subclass_id').append(
                        `<option value="${sub.id}" ${sub.id == data.subclass_id ? 'selected' : ''}>${sub.subclass_name}</option>`
                    );
                });

                $('#editProductModal').modal('show');
            },
            error: function() {
                alert('Failed to load product data.');
            }
        });
    });

   
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?= site_url("transaction/update_product") ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#editProductModal').modal('hide');
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
});
</script>

</body>

</html>