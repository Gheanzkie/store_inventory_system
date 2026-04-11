<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Sales Records</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <!-- CREATE SALE -->
                    <form method="post" action="<?= base_url('sales/create') ?>">
                        <?= csrf_field() ?>
                        <button class="btn btn-success mb-3">+ Sale Record</button>
                    </form>

                    <!-- TABLE -->
                    <table id="allSales" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(!empty($allSales)): ?>
                                <?php foreach($allSales as $sale): ?>
                                    <tr>
                                        <td><?= $sale['id'] ?></td>
                                        <td>₱<?= number_format($sale['total'], 2) ?></td>
                                        <td><?= date('M d, Y h:i A', strtotime($sale['date'])) ?></td>

                                        <td>

                                            <form method="post" action="<?= base_url('sales/delete') ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $sale['id'] ?>">

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this sale?')">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No sales available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#allSales').DataTable({
        responsive: true,
        autoWidth: false
    });
});
</script>

<?= $this->endSection() ?>