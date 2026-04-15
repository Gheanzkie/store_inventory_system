<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-info-circle mr-2"></i>
                <?= session()->getFlashdata('msg') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <div class="row">
                <!-- Main POS Panel -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3 border-0"
                             style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;">
                            <h5 class="mb-0 font-weight-bold">
                                <i class="fas fa-cash-register mr-2"></i>
                                <?php if($activeSale): ?>
                                    Transaction <span class="badge badge-light ml-2">#<?= str_pad($activeSale, 6, '0', STR_PAD_LEFT) ?></span>
                                <?php else: ?>
                                    Point of Sale
                                <?php endif; ?>
                            </h5>
                            <div>
                                <a href="<?= base_url('sales') ?>" class="btn btn-outline-light btn-sm mr-2">
                                    <i class="fas fa-history mr-1"></i> History
                                </a>
                                <a href="<?= base_url('sales_items/create') ?>" class="btn btn-light btn-sm">
                                    <i class="fas fa-plus-circle mr-1"></i> New
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            
                            <!-- Active Transaction Selector -->
                            <form method="get" action="<?= base_url('sales_items') ?>" class="mb-4">
                                <label class="font-weight-semibold text-secondary mb-2">
                                    <i class="fas fa-list-ul mr-1"></i> Active Transactions
                                </label>
                                <select name="sale_id" class="form-control custom-select" onchange="this.form.submit()">
                                    <option value="">— Select Pending Transaction —</option>
                                    <?php foreach($salesList as $s): ?>
                                    <option value="<?= $s['id'] ?>" <?= ($activeSale == $s['id']) ? 'selected' : '' ?>>
                                        #<?= str_pad($s['id'], 6, '0', STR_PAD_LEFT) ?> • 
                                        <?= date('M d, Y • h:i A', strtotime($s['date'])) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </form>

                            <?php if($activeSale): ?>
                            <!-- Add Item Form -->
                            <div class="mb-4 p-3 bg-light rounded-lg">
                                <label class="font-weight-semibold text-secondary mb-3">
                                    <i class="fas fa-cart-plus mr-1"></i> Add Item
                                </label>
                                <form method="post" action="<?= base_url('sales_items/save') ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="sale_id" value="<?= $activeSale ?>">
                                    
                                    <div class="form-row align-items-end">
                                        <div class="col-md-7 mb-2 mb-md-0">
                                            <select name="product_id" class="form-control" required>
                                                <option value="">— Choose Product —</option>
                                                <?php foreach($products as $p): ?>
                                                <option value="<?= $p['id'] ?>">
                                                    <?= esc($p['name']) ?> • ₱<?= number_format($p['price'],2) ?> 
                                                    (Stock: <?= $p['stock'] ?>)
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-2 mb-md-0">
                                            <input type="number" name="quantity" class="form-control" 
                                                   value="1" min="1" placeholder="Quantity" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="fas fa-plus mr-1"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php endif; ?>

                            <!-- Cart Items Table -->
                            <?php if(!empty($salesItems)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr class="text-uppercase small text-secondary">
                                            <th>Item Description</th>
                                            <th class="text-right">Unit Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Amount</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($salesItems as $item): ?>
                                        <tr>
                                            <td class="align-middle font-weight-medium"><?= esc($item['name']) ?></td>
                                            <td class="text-right align-middle">₱<?= number_format($item['price'], 2) ?></td>
                                            <td class="text-center align-middle" style="width: 100px;">
                                                <form method="post" action="<?= base_url('sales_items/update') ?>" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" 
                                                           min="1" class="form-control form-control-sm text-center" 
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="text-right align-middle font-weight-bold">₱<?= number_format($item['subtotal'], 2) ?></td>
                                            <td class="text-center align-middle">
                                                <form method="post" action="<?= base_url('sales_items/delete') ?>">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm border-0" 
                                                            onclick="return confirm('Remove this item?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="bg-light">
                                        <tr>
                                            <th colspan="3" class="text-right align-middle">Total Amount Due</th>
                                            <th class="text-right align-middle h4 mb-0 text-success">₱<?= number_format($total, 2) ?></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Proceed Button -->
                            <div class="text-right mt-3">
                                <button type="button" class="btn btn-success btn-lg px-5 shadow-sm" onclick="showCheckoutModal()">
                                    <i class="fas fa-credit-card mr-2"></i> Proceed to Payment
                                </button>
                            </div>
                            
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-shopping-basket fa-4x text-muted mb-3"></i>
                                    <h5 class="text-muted font-weight-normal">Cart is Empty</h5>
                                    <p class="text-muted mb-0">Add items to begin a new transaction.</p>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <?php if(!empty($salesItems)): ?>
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-gradient-info text-white py-3 border-0"
                             style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;">
                            <h5 class="mb-0 font-weight-bold">
                                <i class="fas fa-clipboard-list mr-2"></i> Order Summary
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h1 class="display-4 text-success font-weight-bold">₱<?= number_format($total, 2) ?></h1>
                                <span class="badge badge-secondary px-3 py-2">Total Due</span>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <h3 class="font-weight-bold text-primary"><?= count($salesItems) ?></h3>
                                    <small class="text-muted text-uppercase font-weight-medium">Items</small>
                                </div>
                                <div class="col-6">
                                    <h3 class="font-weight-bold text-primary"><?= array_sum(array_column($salesItems, 'quantity')) ?></h3>
                                    <small class="text-muted text-uppercase font-weight-medium">Quantity</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light border-0 py-3">
                            <small class="text-muted">
                                <i class="fas fa-hashtag mr-1"></i> 
                                Transaction #<?= str_pad($activeSale, 6, '0', STR_PAD_LEFT) ?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-success text-white border-0"
                 style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-hand-holding-usd mr-2"></i> Process Payment
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <h1 class="display-4 text-success font-weight-bold">₱<?= number_format($total, 2) ?></h1>
                    <span class="badge badge-secondary px-3 py-2">Amount Due</span>
                </div>
                
                <hr class="my-4">
                
                <form method="post" action="<?= base_url('sales_items/checkout') ?>" id="checkoutForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="sale_id" value="<?= $activeSale ?? '' ?>">
                    
                    <div class="form-group">
                        <label class="font-weight-semibold">Payment Method</label>
                        <select name="payment_method" class="form-control custom-select" required>
                            <option value="cash">💵 Cash</option>
                            <option value="card">💳 Debit/Credit Card</option>
                            <option value="gcash">📱 GCash</option>
                            <option value="maya">📱 Maya</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-semibold">Amount Received</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-0">₱</span>
                            </div>
                            <input type="number" name="amount_received" id="amountReceived" 
                                   class="form-control text-right border-0 bg-light" 
                                   value="<?= $total ?? 0 ?>" min="<?= $total ?? 0 ?>" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-semibold">Change</label>
                        <h3 id="changeAmount" class="text-success font-weight-bold mb-0">₱0.00</h3>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </button>
                <button type="submit" form="checkoutForm" class="btn btn-success px-4">
                    <i class="fas fa-check-circle mr-1"></i> Complete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-success text-white border-0"
                 style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-check-circle mr-2"></i> Transaction Complete
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-success border-0 bg-success-light">
                    <i class="fas fa-check-circle mr-2"></i>
                    Transaction has been successfully processed.
                </div>
                <div id="finalReceipt"></div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Close
                </button>
                <div>
                    <button type="button" class="btn btn-primary mr-2" onclick="printFinalReceipt()">
                        <i class="fas fa-print mr-1"></i> Print Receipt
                    </button>
                    <a href="<?= base_url('sales_items/create') ?>" class="btn btn-success">
                        <i class="fas fa-plus-circle mr-1"></i> New Transaction
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var cartTotal = <?= $total ?? 0 ?>;
var cartItems = <?= json_encode($salesItems ?? []) ?>;

function showCheckoutModal() {
    if (cartItems.length === 0) {
        alert('Please add items to cart before proceeding.');
        return;
    }
    $('#checkoutModal').modal('show');
}

function printFinalReceipt() {
    var content = document.getElementById('finalReceipt').innerHTML;
    var printWindow = window.open('', '_blank', 'width=400,height=600');
    printWindow.document.write('<html><head><title>Official Receipt</title>');
    printWindow.document.write('<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">');
    printWindow.document.write('<style>body{padding:20px;font-family:system-ui,sans-serif;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    setTimeout(function() { printWindow.print(); }, 500);
}

$(document).ready(function() {
    $('#amountReceived').on('input', function() {
        var received = parseFloat($(this).val()) || 0;
        var change = received - cartTotal;
        
        if (change >= 0) {
            $('#changeAmount').html('₱' + change.toFixed(2)).removeClass('text-danger').addClass('text-success');
        } else {
            $('#changeAmount').html('₱' + change.toFixed(2) + ' (Insufficient)').removeClass('text-success').addClass('text-danger');
        }
    });
    
    $('#amountReceived').trigger('input');
    
    <?php if(session()->getFlashdata('show_receipt')): ?>
    var receiptId = '<?= session()->getFlashdata('show_receipt') ?>';
    $.ajax({
        url: '<?= base_url('sales_items/receipt') ?>/' + receiptId,
        type: 'GET',
        success: function(data) {
            $('#finalReceipt').html(data);
            $('#receiptModal').modal('show');
        },
        error: function() {
            $('#finalReceipt').html('<div class="alert alert-danger">Unable to load receipt.</div>');
        }
    });
    <?php endif; ?>
});
</script>

<style>
.bg-success-light { background: #d4edda; }
.font-weight-semibold { font-weight: 600; }
.font-weight-medium { font-weight: 500; }
.table td, .table th { vertical-align: middle; }
.custom-select, .form-control { border: 1px solid #e2e8f0; }
.custom-select:focus, .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); }
</style>

<?= $this->endSection() ?>