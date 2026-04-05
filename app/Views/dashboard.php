<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="row">
                <?php if (session()->get('role') === 'admin'): ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalStaff ?? 0 ?></h3>
                            <p>Total Staff</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?= base_url('users') ?>" class="small-box-footer">
                            See More <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalProduct ?? 0 ?></h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cube"></i>
                        </div>
                        <a href="<?= base_url('product') ?>" class="small-box-footer">
                            See More <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>₱<?= number_format($totalSales ?? 0, 2) ?></h3>
                            <p>Total Sales</p>             
                            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#AddSaleModal">
                                <i class="fa fa-plus"></i> Add Sale
                            </button>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                    </div>                  
                </div>
            </div>

            <?php if (session()->get('role') === 'admin'): ?>
            <div class="card mt-3" id="sales">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Sales Transactions</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Staff ID</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($salesList)): ?>
                                <?php foreach ($salesList as $sale): ?>
                                <tr>
                                    <td><?= $sale['id'] ?></td>
                                    <td><?= $sale['user_id'] ?></td>
                                    <td>₱<?= number_format($sale['total'], 2) ?></td>
                                    <td><?= $sale['date'] ?></td>
                                    <td>

                                        <!-- EDIT BUTTON -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSaleModal<?= $sale['id'] ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <!-- DELETE BUTTON -->
                                        <form action="<?= base_url('sales/delete') ?>" method="post" style="display:inline;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $sale['id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this sale?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editSaleModal<?= $sale['id'] ?>">
                                          <div class="modal-dialog">
                                            <form action="<?= base_url('sales/update') ?>" method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $sale['id'] ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Sale</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Total Amount</label>
                                                            <input type="number" name="total" class="form-control" value="<?= $sale['total'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fa fa-save"></i> Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                          </div>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No sales found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<!-- ADD SALE MODAL -->
<div class="modal fade" id="AddSaleModal">
  <div class="modal-dialog">
    <form action="<?= base_url('sales/save') ?>" method="post">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa fa-plus-circle"></i> Add Sale</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Total Amount</label>
            <input type="number" name="total" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>