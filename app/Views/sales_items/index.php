<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales Items</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <select id="productSelect" class="form-control">
                                <?php foreach($products as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['name'] ?> - <?= number_format($p['price'],2) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" id="qty" class="form-control" value="1" min="1">
                        </div>
                        <div class="col-md-2">
                            <button id="addItemBtn" class="btn btn-primary">Add Item</button>
                        </div>
                        <div class="col-md-2">
                            <button id="checkoutBtn" class="btn btn-success">Checkout</button>
                        </div>
                    </div>

                    <table id="salesTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($salesItems)): ?>
                                <?php foreach($salesItems as $item): ?>
                                    <tr data-id="<?= $item['id'] ?>">
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= number_format($item['price'],2) ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price'] * $item['quantity'],2) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger deleteItemBtn">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
</div>

<script>
const baseUrl = "<?= base_url('/') ?>";

$('#addItemBtn').click(function() {
    $.post(baseUrl + 'sales-item/save', {
        product_id: $('#productSelect').val(),
        quantity: $('#qty').val()
    }, function(res){
        if(res.status === 'success') location.reload();
        else alert('Failed to add item');
    }, 'json');
});

$('.deleteItemBtn').click(function() {
    const id = $(this).closest('tr').data('id');
    $.post(baseUrl + 'sales-item/delete', {id}, function(res){
        if(res.status === 'success') location.reload();
        else alert('Failed to delete item');
    }, 'json');
});

$('#checkoutBtn').click(function() {
    $.post(baseUrl + 'sales/checkout', {}, function(res){
        alert(res.message);
        if(res.status === 'success') location.reload();
    }, 'json');
});

$(document).ready(function() {
    $('#salesTable').DataTable({
        responsive: true,
        autoWidth: false,
    });
});
</script>

<?= $this->endSection() ?>