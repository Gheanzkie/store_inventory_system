<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-history mr-2"></i>Sales History
                    </h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= base_url('sales_items') ?>" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-cash-register mr-1"></i>Point of Sale
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-info-circle mr-2"></i> <?= session()->getFlashdata('msg') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-3 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-normal text-secondary mb-0">
                            <i class="fas fa-list mr-2"></i>Transaction Records
                        </h3>
                        <span class="badge badge-light text-muted">
                            <i class="fas fa-database mr-1"></i><?= count($allSales) ?> records
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr class="small text-secondary text-uppercase">
                                    <th class="pl-3">Receipt #</th>
                                    <th>Date & Time</th>
                                    <th class="text-right">Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th class="text-center pr-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($allSales)): ?>
                                    <?php foreach($allSales as $sale): ?>
                                    <tr>
                                        <td class="pl-3 font-weight-medium">
                                            #<?= str_pad($sale['id'], 6, '0', STR_PAD_LEFT) ?>
                                        </td>
                                        <td>
                                            <div class="font-weight-medium"><?= date('M d, Y', strtotime($sale['date'])) ?></div>
                                            <small class="text-muted"><?= date('h:i A', strtotime($sale['date'])) ?></small>
                                        </td>
                                        <td class="text-right">
                                            <span class="font-weight-bold text-success">₱<?= number_format($sale['total'], 2) ?></span>
                                        </td>
                                        <td>
                                            <?php if(!empty($sale['payment_method'])): ?>
                                                <span class="badge badge-secondary">
                                                    <?= ucfirst($sale['payment_method']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($sale['status'] == 'completed'): ?>
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle mr-1"></i>Completed
                                                </span>
                                            <?php elseif($sale['status'] == 'pending'): ?>
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock mr-1"></i>Pending
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary"><?= $sale['status'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center pr-3">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <?php if($sale['status'] == 'completed'): ?>
                                                <a href="<?= base_url('sales/view/' . $sale['id']) ?>" 
                                                   class="btn btn-outline-secondary" target="_blank" title="View Receipt">
                                                    <i class="fas fa-receipt"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if(session()->get('role') === 'admin'): ?>
                                                <form method="post" action="<?= base_url('sales/delete') ?>" class="d-inline">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= $sale['id'] ?>">
                                                    <button type="submit" class="btn btn-outline-danger" 
                                                            onclick="return confirm('Delete this transaction?')" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-receipt fa-3x mb-3 opacity-50"></i>
                                            <h5 class="font-weight-normal">No transactions found</h5>
                                            <p class="small mb-0">Start a new transaction from the POS</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if(!empty($allSales)): ?>
                <div class="card-footer bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center small text-muted">
                        <span><i class="fas fa-info-circle mr-1"></i>Showing all transactions</span>
                        <span>Total: <?= count($allSales) ?> records</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
</div>

<style>
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.table tbody tr:last-child { border-bottom: none; }
.table thead th { border-bottom: 1px solid #e5e7eb; font-weight: 500; padding: 12px 8px; }
.table td { padding: 14px 8px; }
.btn-secondary { background: #6b7280; border-color: #6b7280; }
.btn-secondary:hover { background: #4b5563; border-color: #4b5563; }
.btn-outline-secondary { border-color: #d1d5db; color: #4b5563; }
.btn-outline-secondary:hover { background: #f3f4f6; border-color: #9ca3af; color: #374151; }
.btn-outline-danger { border-color: #fecaca; color: #991b1b; }
.btn-outline-danger:hover { background: #fee2e2; border-color: #fca5a5; color: #7f1d1d; }
.badge-secondary { background: #6b7280; color: white; }
.badge-success { background: #10b981; color: white; }
.badge-warning { background: #f59e0b; color: white; }
.font-weight-medium { font-weight: 500; }
.opacity-50 { opacity: 0.5; }
</style>

<?= $this->endSection() ?>