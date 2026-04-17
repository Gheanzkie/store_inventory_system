<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-info-circle mr-2"></i> <?= session()->getFlashdata('msg') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white py-3 border-0" style="background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%) !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 font-weight-bold">
                                    <i class="fas fa-cash-register mr-2"></i>Point of Sale
                                    <span class="badge badge-light ml-2">#<?= str_pad($activeSale, 6, '0', STR_PAD_LEFT) ?></span>
                                </h5>
                                <a href="<?= base_url('sales') ?>" class="btn btn-outline-light btn-sm">
                                    <i class="fas fa-history mr-1"></i>History
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            
                            <!-- Category Filter -->
                            <div class="mb-3 d-flex flex-wrap gap-1">
                                <a href="<?= base_url('sales_items?sale_id=' . $activeSale) ?>" 
                                   class="btn btn-sm <?= empty($selectedCategory) ? 'btn-secondary' : 'btn-outline-secondary' ?> mb-1">
                                    All
                                </a>
                                <?php foreach($categories as $cat): ?>
                                <a href="<?= base_url('sales_items?sale_id=' . $activeSale . '&category=' . $cat['id']) ?>" 
                                   class="btn btn-sm <?= $selectedCategory == $cat['id'] ? 'btn-secondary' : 'btn-outline-secondary' ?> mb-1">
                                    <?= esc($cat['category_name']) ?>
                                </a>
                                <?php endforeach; ?>
                            </div>

                            <!-- Add Item Form -->
                            <form method="post" action="<?= base_url('sales_items/save') ?>" class="bg-light p-3 rounded mb-3">
                                <?= csrf_field() ?>
                                <input type="hidden" name="sale_id" value="<?= $activeSale ?>">
                                <div class="form-row">
                                    <div class="col-md-7 mb-2">
                                        <select name="product_id" class="form-control border-0 shadow-sm" required>
                                            <option value="">— Select Product —</option>
                                            <?php foreach($products as $p): ?>
                                            <option value="<?= $p['id'] ?>">
                                                <?= esc($p['name']) ?> • ₱<?= number_format($p['price'],2) ?> (<?= $p['stock'] ?>)
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="number" name="quantity" class="form-control border-0 shadow-sm" value="1" min="1" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-secondary btn-block shadow-sm">
                                            <i class="fas fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Cart Items -->
                            <?php if(!empty($salesItems)): ?>
                            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-sm table-hover">
                                    <thead class="bg-light small text-secondary">
                                        <tr><th>Item</th><th class="text-right">Price</th><th class="text-center">Qty</th><th class="text-right">Amount</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($salesItems as $item): ?>
                                        <tr>
                                            <td class="font-weight-medium"><?= esc($item['name']) ?></td>
                                            <td class="text-right">₱<?= number_format($item['price'], 2) ?></td>
                                            <td class="text-center" style="width:80px">
                                                <form method="post" action="<?= base_url('sales_items/update') ?>">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" 
                                                           class="form-control form-control-sm text-center shadow-sm" onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="text-right font-weight-bold text-success">₱<?= number_format($item['subtotal'], 2) ?></td>
                                            <td class="text-center">
                                                <form method="post" action="<?= base_url('sales_items/delete') ?>">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm border-0" 
                                                            onclick="return confirm('Remove item?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-shopping-basket fa-4x mb-3 opacity-50"></i>
                                    <h5 class="font-weight-normal">Cart is empty</h5>
                                    <p class="small">Add products to begin a new transaction.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Payment Sidebar -->
                <div class="col-lg-4">
                    <?php if(!empty($salesItems)): ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%) !important;">
                            <h5 class="mb-0 font-weight-bold"><i class="fas fa-credit-card mr-2"></i>Payment</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <span class="text-muted small text-uppercase">Total Amount Due</span>
                                <h1 class="display-4 text-success font-weight-bold">₱<?= number_format($total, 2) ?></h1>
                            </div>
                            
                            <form method="post" action="<?= base_url('sales_items/checkout') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="sale_id" value="<?= $activeSale ?>">
                                
                                <div class="form-group">
                                    <label class="small font-weight-semibold text-secondary">Payment Method</label>
                                    <select name="payment_method" class="form-control border-0 shadow-sm">
                                        <option value="cash">💵 Cash</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="small font-weight-semibold text-secondary">Amount Received</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-0">₱</span>
                                        </div>
                                        <input type="number" name="amount_received" id="amountReceived" 
                                               class="form-control text-right border-0" value="<?= $total ?>" 
                                               min="<?= $total ?>" step="0.01" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="small font-weight-semibold text-secondary">Change</label>
                                    <h3 id="changeAmount" class="text-success font-weight-bold">₱0.00</h3>
                                </div>
                                
                                <button type="submit" class="btn btn-success btn-block btn-lg shadow-sm mt-4">
                                    <i class="fas fa-check-circle mr-2"></i>Complete Transaction
                                </button>
                            </form>
                        </div>
                        <div class="card-footer bg-light border-0 py-3">
                            <div class="d-flex justify-content-between small text-muted">
                                <span><i class="fas fa-receipt mr-1"></i> Items: <?= count($salesItems) ?></span>
                                <span><i class="fas fa-cubes mr-1"></i> Qty: <?= array_sum(array_column($salesItems, 'quantity')) ?></span>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%) !important;">
                            <h5 class="mb-0 font-weight-bold"><i class="fas fa-info-circle mr-2"></i>Ready</h5>
                        </div>
                        <div class="card-body p-4 text-center text-muted">
                            <i class="fas fa-arrow-left fa-2x mb-3 opacity-50"></i>
                            <p class="small">Add items to begin transaction</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
var total = <?= $total ?? 0 ?>;
$('#amountReceived').on('input', function() {
    var change = (parseFloat($(this).val()) || 0) - total;
    $('#changeAmount').html('₱' + (change >= 0 ? change.toFixed(2) : change.toFixed(2) + ' ⚠️'))
        .toggleClass('text-success', change >= 0)
        .toggleClass('text-danger', change < 0);
}).trigger('input');
</script>

<style>
.font-weight-semibold { font-weight: 600; }
.font-weight-medium { font-weight: 500; }
.table td, .table th { vertical-align: middle; border: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.table tbody tr:last-child { border-bottom: none; }
.gap-2 { gap: 0.5rem; }
.opacity-50 { opacity: 0.5; }
.btn-secondary { background: #6b7280; border-color: #6b7280; }
.btn-secondary:hover { background: #4b5563; border-color: #4b5563; }
.btn-outline-secondary { border-color: #d1d5db; color: #4b5563; }
.btn-outline-secondary:hover { background: #f3f4f6; border-color: #9ca3af; color: #374151; }
.form-control:focus { box-shadow: 0 0 0 0.2rem rgba(107, 114, 128, 0.15); border-color: #9ca3af; }
.card { border-radius: 10px; }
</style>

<?= $this->endSection() ?>