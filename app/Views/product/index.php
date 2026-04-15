<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-boxes mr-2"></i> Products
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Alert Container -->
            <div id="alertContainer"></div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0">
                                    <i class="fas fa-list mr-2"></i> Product List
                                </h3>
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#addProductModal">
                                    <i class="fas fa-plus mr-1"></i> Add Product
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table id="productTable" class="table table-hover table-sm">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary text-uppercase">
                                            <th width="5%">#</th>
                                            <th style=" display: none;">ID</th>
                                                  <th width="20%">Category</th>
                                            <th width="30%">Product Name</th>
                                            <th width="15%" class="text-right">Price</th>
                                            <th width="10%" class="text-center">Stock</th>
                                            <th width="20%" class="text-center">Actions</th>
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
            </div>
        </div>
    </section>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form id="addProductForm">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-normal text-secondary">
                        <i class="fas fa-plus-circle mr-2"></i> Add New Product
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Category</label>
                        <select name="category_id" class="form-control custom-select" required>
                            <option value="" selected disabled>— Select Category —</option>
                            <option value="1">🥤 Beverages</option>
                            <option value="2">🍪 Snacks</option>
                            <option value="3">🥫 Canned Goods</option>
                            <option value="4">🧴 Personal Care</option>
                            <option value="5">🏠 Household Items</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g., Coke" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Price (₱)</label>
                                <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Stock</label>
                                <input type="number" name="stock" class="form-control" placeholder="0" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form id="editProductForm">
                <?= csrf_field() ?>
                <input type="hidden" id="editId" name="id">
                
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-normal text-secondary">
                        <i class="fas fa-edit mr-2"></i> Edit Product
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Category</label>
                        <select name="category_id" id="editCategoryId" class="form-control custom-select" required>
                            <option value="" disabled>— Select Category —</option>
                            <option value="1">🥤 Beverages</option>
                            <option value="2">🍪 Snacks</option>
                            <option value="3">🥫 Canned Goods</option>
                            <option value="4">🧴 Personal Care</option>
                            <option value="5">🏠 Household Items</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Product Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Price (₱)</label>
                                <input type="number" name="price" id="editPrice" class="form-control" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Stock</label>
                                <input type="number" name="stock" id="editStock" class="form-control" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toasts-top-right fixed" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999;"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script> const baseUrl = "<?= base_url() ?>"; </script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

<!-- DataTables JS -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>

<!-- Custom Product JS -->
<script src="<?= base_url('js/product/product.js') ?>"></script>

<style>
.card {
    border-radius: 10px;
}
.table td, .table th {
    vertical-align: middle;
    border-top: none;
}
.table tbody tr {
    border-bottom: 1px solid #f3f4f6;
}
.table tbody tr:last-child {
    border-bottom: none;
}
.table thead th {
    border-bottom: 1px solid #e5e7eb;
    font-weight: 500;
}
.btn-outline-secondary {
    border-color: #d1d5db;
    color: #4b5563;
}
.btn-outline-secondary:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: #374151;
}
.btn-secondary {
    background: #6b7280;
    border-color: #6b7280;
}
.btn-secondary:hover {
    background: #4b5563;
    border-color: #4b5563;
}
.modal-content {
    border-radius: 12px;
}
.custom-select, .form-control {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.9rem;
}
.custom-select:focus, .form-control:focus {
    border-color: #9ca3af;
    box-shadow: 0 0 0 0.2rem rgba(107, 114, 128, 0.15);
}
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1rem;
}
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 4px 8px;
}
.page-item.active .page-link {
    background-color: #6b7280;
    border-color: #6b7280;
}
.page-link {
    color: #4b5563;
}
.page-link:hover {
    color: #374151;
}
</style>
<?= $this->endSection() ?>