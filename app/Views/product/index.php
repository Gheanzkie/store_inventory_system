<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-boxes mr-2"></i>Products
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
            
            <!-- INVENTORY ALERT CARDS -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="totalProductsCount">0</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="wellStockedCount">0</h3>
                            <p>Well Stocked (>10)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="lowStockCount">0</h3>
                            <p>Low Stock (1-10)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="outOfStockCount">0</h3>
                            <p>Out of Stock (0)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LOW STOCK ALERT BANNER -->
            <div id="lowStockAlert" style="display: none;" class="alert alert-warning alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <strong>Inventory Alert!</strong> <span id="lowStockMessage"></span>
            </div>

            <div id="alertContainer"></div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title font-weight-normal text-secondary mb-0">
                                        <i class="fas fa-cube mr-2"></i>Product Catalog
                                    </h3>
                                    <span class="badge badge-light text-muted ml-3">
                                        <i class="fas fa-database mr-1"></i><span id="countDisplay">0</span> items
                                    </span>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm shadow-sm" data-toggle="modal" data-target="#addProductModal">
                                    <i class="fas fa-plus mr-1"></i>Add Product
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- Search Bar -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchProduct" class="form-control border-left-0 shadow-none" placeholder="Search products...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select id="stockFilter" class="form-control form-control-sm shadow-none">
                                        <option value="">All Stock Status</option>
                                        <option value="critical">Critical (0-5)</option>
                                        <option value="low">Low Stock (1-10)</option>
                                        <option value="normal">Normal (>10)</option>
                                        <option value="out">Out of Stock (0)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Product Cards Grid -->
                            <div class="product-grid" style="max-height: 550px; overflow-y: auto;">
                                <div class="row" id="productCardsContainer">
                                    <!-- Products will be loaded here via AJAX -->
                                </div>
                            </div>
                            
                            <!-- Loading spinner -->
                            <div id="loadingSpinner" class="text-center py-4">
                                <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                                <p class="mt-2 text-muted">Loading products...</p>
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
                    <h5 class="modal-title font-weight-medium text-secondary">
                        <i class="fas fa-plus-circle mr-2"></i>Add New Product
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Category</label>
                        <select name="category_id" class="form-control custom-select shadow-sm" required>
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
                        <input type="text" name="name" class="form-control shadow-sm" placeholder="e.g., Coke" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Price (₱)</label>
                                <input type="number" name="price" class="form-control shadow-sm" placeholder="0.00" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Stock</label>
                                <input type="number" name="stock" class="form-control shadow-sm" placeholder="0" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4 shadow-sm">
                        <i class="fas fa-save mr-1"></i>Save
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
                    <h5 class="modal-title font-weight-medium text-secondary">
                        <i class="fas fa-edit mr-2"></i>Edit Product
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Category</label>
                        <select name="category_id" id="editCategoryId" class="form-control custom-select shadow-sm" required>
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
                        <input type="text" name="name" id="editName" class="form-control shadow-sm" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Price (₱)</label>
                                <input type="number" name="price" id="editPrice" class="form-control shadow-sm" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Stock</label>
                                <input type="number" name="stock" id="editStock" class="form-control shadow-sm" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4 shadow-sm">
                        <i class="fas fa-save mr-1"></i>Update
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

<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>

<style>
.card { border-radius: 10px; }
.product-grid { max-height: 550px; overflow-y: auto; padding: 0 5px; }
.product-card {
    border-radius: 12px;
    background: white;
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    border: 1px solid #e5e7eb;
    height: 100%;
    cursor: pointer;
}
.product-card:hover { transform: translateY(-3px); box-shadow: 0 6px 12px rgba(0,0,0,0.1); border-color: #cbd5e0; }
.product-card.critical { border-left: 3px solid #dc3545; }
.product-card.low { border-left: 3px solid #ffc107; }
.product-card.out { border-left: 3px solid #6c757d; background: #f8f9fa; }
.product-card.normal { border-left: 3px solid #28a745; }
.product-card-inner { padding: 15px 12px; text-align: center; }
.product-icon { font-size: 2.5rem; margin-bottom: 8px; }
.product-name { font-size: 0.9rem; font-weight: 600; margin-bottom: 5px; color: #2d3748; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.product-price { font-size: 1rem; font-weight: bold; color: #28a745; margin-bottom: 5px; }
.product-stock { font-size: 0.7rem; margin-bottom: 8px; }
.stock-critical { color: #dc3545; font-weight: bold; }
.stock-low { color: #ffc107; font-weight: bold; }
.stock-normal { color: #28a745; }
.stock-out { color: #6c757d; }
.btn-edit, .btn-delete {
    background: transparent;
    border: none;
    padding: 5px 8px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-edit { color: #6b7280; }
.btn-edit:hover { background: #e5e7eb; color: #374151; }
.btn-delete { color: #dc3545; }
.btn-delete:hover { background: #fee2e2; color: #b91c1c; }
.btn-secondary { background: #6b7280; border-color: #6b7280; }
.btn-secondary:hover { background: #4b5563; border-color: #4b5563; }
.btn-outline-secondary { border-color: #d1d5db; color: #4b5563; }
.btn-outline-secondary:hover { background: #f3f4f6; border-color: #9ca3af; color: #374151; }
.modal-content { border-radius: 12px; }
.custom-select, .form-control { border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem; }
</style>

<script>
$(document).ready(function() {
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';
    var allProducts = [];
    
    // Load all products
    function loadProducts() {
        $('#loadingSpinner').show();
        
        $.ajax({
            url: baseUrl + 'product/fetchRecords',
            type: 'POST',
            data: {
                length: 10000,
                start: 0,
                [csrfName]: csrfHash
            },
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    allProducts = res.data;
                    updateInventoryCounters(allProducts);
                    renderProducts(allProducts);
                }
                $('#loadingSpinner').hide();
            },
            error: function() {
                $('#loadingSpinner').html('<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-circle"></i> Failed to load products</div>');
            }
        });
    }
    
    // Render products as cards
    function renderProducts(products) {
        var container = $('#productCardsContainer');
        container.empty();
        
        if (!products || products.length === 0) {
            container.html('<div class="col-12 text-center py-5 text-muted"><i class="fas fa-box-open fa-4x mb-3"></i><h5>No products found</h5></div>');
            $('#countDisplay').text('0');
            return;
        }
        
        var html = '';
        products.forEach(function(product) {
            var stock = parseInt(product.stock);
            var statusClass = '';
            var statusText = '';
            var stockClass = '';
            
            if (stock <= 0) {
                statusClass = 'out';
                statusText = 'Out of Stock';
                stockClass = 'stock-out';
            } else if (stock <= 5) {
                statusClass = 'critical';
                statusText = 'Critical: ' + stock;
                stockClass = 'stock-critical';
            } else if (stock <= 10) {
                statusClass = 'low';
                statusText = 'Low Stock: ' + stock;
                stockClass = 'stock-low';
            } else {
                statusClass = 'normal';
                statusText = stock + ' left';
                stockClass = 'stock-normal';
            }
            
            var icons = {1: '🥤', 2: '🍪', 3: '🥫', 4: '🧴', 5: '🏠'};
            var icon = icons[product.category_id] || '📦';
            
            html += `
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3 product-card-item" data-name="${escapeHtml(product.name).toLowerCase()}" data-stock="${stock}" data-category="${product.category_id}">
                    <div class="product-card ${statusClass}">
                        <div class="product-card-inner">
                            <div class="product-icon">${icon}</div>
                            <h6 class="product-name" title="${escapeHtml(product.name)}">${escapeHtml(product.name)}</h6>
                            <div class="product-price">₱${parseFloat(product.price).toFixed(2)}</div>
                            <div class="product-stock ${stockClass}">
                                <i class="fas ${stock <= 0 ? 'fa-ban' : (stock <= 5 ? 'fa-exclamation-triangle' : 'fa-box')}"></i> ${statusText}
                            </div>
                            <div class="mt-2">
                                <button class="btn-edit" onclick="editProduct(${product.id})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-delete" onclick="deleteProduct(${product.id}, '${escapeHtml(product.name)}')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        container.html(html);
        $('#countDisplay').text(products.length);
    }
    
    // Update inventory counters
    function updateInventoryCounters(products) {
        var total = products.length;
        var wellStocked = 0;
        var lowStock = 0;
        var outOfStock = 0;
        
        products.forEach(function(product) {
            var stock = parseInt(product.stock);
            if (stock <= 0) outOfStock++;
            else if (stock <= 10) lowStock++;
            else wellStocked++;
        });
        
        $('#totalProductsCount').text(total);
        $('#wellStockedCount').text(wellStocked);
        $('#lowStockCount').text(lowStock);
        $('#outOfStockCount').text(outOfStock);
        
        if (lowStock > 0 || outOfStock > 0) {
            $('#lowStockAlert').show();
            var msg = [];
            if (lowStock > 0) msg.push(lowStock + ' product(s) low on stock');
            if (outOfStock > 0) msg.push(outOfStock + ' product(s) out of stock');
            $('#lowStockMessage').text(msg.join(', ') + '!');
        } else {
            $('#lowStockAlert').hide();
        }
    }
    
    // Filter products
    function filterProducts() {
        var search = $('#searchProduct').val().toLowerCase();
        var stockFilter = $('#stockFilter').val();
        
        var filtered = allProducts.filter(function(product) {
            var matchSearch = product.name.toLowerCase().indexOf(search) > -1;
            var stock = parseInt(product.stock);
            var matchStock = true;
            
            if (stockFilter === 'critical') matchStock = (stock <= 5 && stock > 0);
            else if (stockFilter === 'low') matchStock = (stock <= 10 && stock > 0);
            else if (stockFilter === 'normal') matchStock = (stock > 10);
            else if (stockFilter === 'out') matchStock = (stock === 0);
            
            return matchSearch && matchStock;
        });
        
        renderProducts(filtered);
    }
    
    // Search and filter events
    $('#searchProduct').on('keyup', function() { filterProducts(); });
    $('#stockFilter').on('change', function() { filterProducts(); });
    
    // Add Product
    $('#addProductForm').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('button[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
        
        $.ajax({
            url: baseUrl + 'product/save',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#addProductModal').modal('hide');
                    showToast('success', 'Product added successfully');
                    loadProducts();
                    $('#addProductForm')[0].reset();
                } else {
                    showToast('error', res.message || 'Failed to save');
                }
            },
            error: function() { showToast('error', 'An error occurred'); },
            complete: function() { $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i>Save'); }
        });
    });
    
    // Edit functions
    window.editProduct = function(id) {
        $.ajax({
            url: baseUrl + 'product/edit/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    $('#editId').val(res.data.id);
                    $('#editCategoryId').val(res.data.category_id);
                    $('#editName').val(res.data.name);
                    $('#editPrice').val(res.data.price);
                    $('#editStock').val(res.data.stock);
                    $('#editProductModal').modal('show');
                } else {
                    showToast('error', 'Failed to load product data');
                }
            }
        });
    };
    
    // Update Product
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();
        var $btn = $(this).find('button[type="submit"]');
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
        
        $.ajax({
            url: baseUrl + 'product/update',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    $('#editProductModal').modal('hide');
                    showToast('success', res.message);
                    loadProducts();
                } else {
                    showToast('error', res.message || 'Failed to update');
                }
            },
            error: function() { showToast('error', 'Error updating product'); },
            complete: function() { $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i>Update'); }
        });
    });
    
    // Delete Product
    window.deleteProduct = function(id, name) {
        if (!confirm('Delete product "' + name + '"?')) return;
        
        $.ajax({
            url: baseUrl + 'product/delete/' + id,
            type: 'DELETE',
            data: { [csrfName]: csrfHash },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    showToast('success', res.message);
                    loadProducts();
                } else {
                    showToast('error', res.message || 'Failed to delete');
                }
            },
            error: function() { showToast('error', 'Error deleting product'); }
        });
    };
    
    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }
    
    function showToast(type, message) {
        var bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
        var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        var toast = $(`
            <div class="toast ${bgClass}" role="alert" data-autohide="true" data-delay="3000" style="min-width: 250px;">
                <div class="toast-body text-white">
                    <i class="fas ${icon} mr-2"></i> ${message}
                </div>
            </div>
        `);
        $('.toasts-top-right').append(toast);
        toast.toast('show');
        setTimeout(function() { toast.remove(); }, 3000);
    }
    
    // Initial load
    loadProducts();
});
</script>
<?= $this->endSection() ?>