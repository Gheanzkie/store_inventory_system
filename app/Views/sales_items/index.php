<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle mr-2"></i> <?= esc(session()->getFlashdata('msg')) ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <div class="row">
                <!-- Products Section - Card View -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-boxes mr-2"></i>Products
                                <span class="badge badge-light ml-2">#<?= str_pad($activeSale ?? '0', 6, '0', STR_PAD_LEFT) ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            
                            <!-- Category Filter -->
                            <div class="mb-3">
                                <a href="?sale_id=<?= $activeSale ?? '' ?>" class="btn btn-sm <?= empty($selectedCategory) ? 'btn-dark' : 'btn-outline-secondary' ?>">All</a>
                                <?php if(!empty($categories)): ?>
                                <?php foreach($categories as $cat): ?>
                                <a href="?category=<?= $cat['id'] ?>&sale_id=<?= $activeSale ?? '' ?>" class="btn btn-sm <?= (isset($selectedCategory) && $selectedCategory == $cat['id']) ? 'btn-dark' : 'btn-outline-secondary' ?>">
                                    <?= esc($cat['category_name']) ?>
                                </a>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Search -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search products...">
                            </div>

                            <!-- Product Cards -->
                            <div class="row" id="productContainer">
                                <?php if(!empty($products)): ?>
                                <?php foreach($products as $p): 
                                    $stock = (int)($p['stock'] ?? 0);
                                ?>
                                <div class="col-md-4 col-sm-6 mb-3 product-item" data-name="<?= strtolower($p['name']) ?>">
                                    <div class="card h-100 text-center">
                                        <div class="card-body">
                                            <div class="display-4">
                                                <?php 
                                                $icons = [1 => '🥤', 2 => '🍪', 3 => '🥫', 4 => '🧴', 5 => '🏠'];
                                                $icon = $icons[$p['category_id'] ?? 1] ?? '📦';
                                                echo $icon;
                                                ?>
                                            </div>
                                            <h6 class="mt-2"><?= esc($p['name']) ?></h6>
                                            <div class="text-success font-weight-bold">₱<?= number_format($p['price'], 2) ?></div>
                                            <div class="small <?= $stock <= 5 ? 'text-warning' : 'text-muted' ?>">
                                                Stock: <?= $stock ?>
                                            </div>
                                            <?php if($stock > 0): ?>
                                            <form method="post" action="<?= base_url('sales_items/save') ?>" class="mt-2">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="sale_id" value="<?= $activeSale ?? '' ?>">
                                                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block">
                                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                                </button>
                                            </form>
                                            <?php else: ?>
                                            <button class="btn btn-secondary btn-sm btn-block mt-2" disabled>
                                                <i class="fas fa-times"></i> Out of Stock
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <div class="col-12 text-center">
                                    <p class="text-muted">No products found</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Section -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-shopping-cart mr-2"></i>Cart</h5>
                        </div>
                        <div class="card-body p-0">
                            <?php if(!empty($salesItems)): ?>
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Item</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($salesItems as $item): ?>
                                    <tr>
                                        <td>
                                            <?= esc($item['name']) ?>
                                            <div class="small text-muted">₱<?= number_format($item['price'], 2) ?></div>
                                        </td>
                                        <td class="text-center" style="width:80px">
                                            <form method="post" action="<?= base_url('sales_items/update') ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" 
                                                       class="form-control form-control-sm" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="text-right text-success">₱<?= number_format($item['subtotal'], 2) ?></td>
                                        <td class="text-center">
                                            <form method="post" action="<?= base_url('sales_items/delete') ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td colspan="2" class="text-right"><strong>TOTAL</strong></td>
                                        <td class="text-right text-success"><strong>₱<?= number_format($total ?? 0, 2) ?></strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                             </table>
                            <?php else: ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-shopping-cart fa-3x mb-2"></i>
                                <p>Cart is empty</p>
                                <small>Click "Add to Cart" on products</small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="card mt-3">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-credit-card mr-2"></i>Payment</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('sales_items/checkout') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="sale_id" value="<?= $activeSale ?? '' ?>">
                                
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select name="payment_method" class="form-control">
                                        <option value="cash">💵 Cash</option>
                                        <option value="gcash">📱 GCash</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Amount Received</label>
                                    <input type="number" name="amount_received" id="amountReceived" 
                                           class="form-control" value="<?= $total ?? 0 ?>" 
                                           min="<?= $total ?? 0 ?>" step="1" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Change</label>
                                    <h3 id="changeAmount" class="text-success">₱0.00</h3>
                                </div>
                                
                                <button type="submit" class="btn btn-success btn-block" id="checkoutBtn">
                                    <i class="fas fa-check-circle"></i> Complete Transaction
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="mt-2 text-center">
                        <a href="<?= base_url('sales_items/new') ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-plus"></i> New Transaction
                        </a>
                        <a href="<?= base_url('sales') ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-history"></i> History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Search filter
var searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('keyup', function() {
        var search = this.value.toLowerCase();
        var items = document.querySelectorAll('.product-item');
        items.forEach(function(item) {
            var name = item.getAttribute('data-name');
            if (name && name.indexOf(search) > -1) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
}

// Change calculation
var total = <?= json_encode($total ?? 0) ?>;
var amountInput = document.getElementById('amountReceived');
var changeSpan = document.getElementById('changeAmount');
var checkoutBtn = document.getElementById('checkoutBtn');

function updateChange() {
    if (amountInput) {
        var received = parseFloat(amountInput.value) || 0;
        var change = received - total;
        
        if (change >= 0) {
            changeSpan.innerHTML = '₱' + change.toFixed(2);
            changeSpan.classList.remove('text-danger');
            changeSpan.classList.add('text-success');
            if (checkoutBtn) checkoutBtn.disabled = false;
        } else {
            changeSpan.innerHTML = '₱' + change.toFixed(2);
            changeSpan.classList.remove('text-success');
            changeSpan.classList.add('text-danger');
            if (checkoutBtn) checkoutBtn.disabled = true;
        }
    }
}

if (amountInput) {
    amountInput.addEventListener('input', updateChange);
    updateChange();
}
</script>

<style>
.card { border-radius: 8px; }
.btn-primary { background: #6b7280; border-color: #6b7280; }
.btn-primary:hover { background: #4b5563; border-color: #4b5563; }
.btn-dark { background: #2d3748; border-color: #2d3748; }
.product-item .card { transition: transform 0.2s; }
.product-item .card:hover { transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
</style>

<?= $this->endSection() ?>