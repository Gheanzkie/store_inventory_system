<div style="font-family: 'Courier New', monospace;">
    <div class="text-center mb-3">
        <h4 style="margin:0; font-weight: bold;">HISONA STORE</h4>
        <p style="margin:0; font-size: 14px;">Brgy Tabugon, Kabankalan City</p>
        <p style="margin:0; font-size: 14px;">Tel: 0912-345-6789</p>
    </div>
    
    <hr>
    
    <div class="row mb-2">
        <div class="col-6">
            <strong>Receipt #:</strong> <?= str_pad($sale['id'], 6, '0', STR_PAD_LEFT) ?>
        </div>
        <div class="col-6 text-right">
            <strong>Date:</strong> <?= date('M d, Y', strtotime($sale['date'])) ?>
        </div>
    </div>
    
    <div class="row mb-2">
        <div class="col-6">
            <strong>Time:</strong> <?= date('h:i A', strtotime($sale['date'])) ?>
        </div>
        <div class="col-6 text-right">
            <strong>Payment:</strong> <?= ucfirst($sale['payment_method'] ?? 'Cash') ?>
        </div>
    </div>
    
    <hr>
    
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Product</th>
                <th class="text-right">Price</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td class="text-right">₱<?= number_format($item['price'], 2) ?></td>
                <td class="text-center"><?= $item['quantity'] ?></td>
                <td class="text-right">₱<?= number_format($item['subtotal'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">TOTAL:</th>
                <th class="text-right">₱<?= number_format($total, 2) ?></th>
            </tr>
        </tfoot>
    </table>
    
    <hr>
    
    <table class="table table-sm table-borderless">
        <tr>
            <td><strong>Amount Received:</strong></td>
            <td class="text-right">₱<?= number_format($sale['amount_received'] ?? $total, 2) ?></td>
        </tr>
        <tr>
            <td><strong>Change:</strong></td>
            <td class="text-right">₱<?= number_format($sale['change_amount'] ?? 0, 2) ?></td>
        </tr>
    </table>
    
    <hr>
    
    <div class="text-center mt-3">
        <p style="margin:0;"><strong>Thank you for your purchase!</strong></p>
        <p style="margin:0;">Have a great day! 😊</p>
    </div>
</div>