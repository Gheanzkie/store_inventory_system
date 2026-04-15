<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sales History</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= base_url('sales_items') ?>" class="btn btn-primary">
                        <i class="fas fa-cart-plus"></i> POS
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= session()->getFlashdata('msg') ?>
            </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($allSales)): ?>
                                <?php foreach($allSales as $sale): ?>
                                <tr>
                                    <td><strong>#<?= str_pad($sale['id'], 5, '0', STR_PAD_LEFT) ?></strong></td>
                                    <td><?= date('M d, Y h:i A', strtotime($sale['date'])) ?></td>
                                    <td><strong class="text-success">₱<?= number_format($sale['total'], 2) ?></strong></td>
                                    <td>
                                        <?php if(!empty($sale['payment_method'])): ?>
                                            <span class="badge badge-info">
                                                <?= ucfirst($sale['payment_method']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($sale['status'] == 'completed'): ?>
                                            <span class="badge badge-success">Completed</span>
                                        <?php elseif($sale['status'] == 'pending'): ?>
                                            <span class="badge badge-warning">Pending</span>
                                            <a href="<?= base_url('sales_items?sale_id=' . $sale['id']) ?>" 
                                               class="btn btn-sm btn-info ml-2">
                                                <i class="fas fa-play"></i> Continue
                                            </a>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?= $sale['status'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($sale['status'] == 'completed'): ?>
                                            <a href="<?= base_url('sales/view/' . $sale['id']) ?>" 
                                               class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-receipt"></i> View Receipt
                                            </a>
                                        <?php endif; ?>
                                        
                                        <form method="post" action="<?= base_url('sales/delete') ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $sale['id'] ?>">
                                            <button class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Delete this sale?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted">No sales records</p>
                                        <a href="<?= base_url('sales_items') ?>" class="btn btn-primary">
                                            <i class="fas fa-cart-plus"></i> Start New Transaction
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>