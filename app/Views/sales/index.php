<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">All Sales</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="allSales" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($allSales)): ?>
                                <?php foreach($allSales as $sale): ?>
                                    <tr>
                                        <td><?= $sale['id'] ?></td>
                                        <td>₱<?= number_format($sale['total'], 2) ?></td>
                                        <td><?= $sale['date'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No sales available</td>
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