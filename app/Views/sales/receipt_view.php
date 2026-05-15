<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #<?= isset($sale['id']) ? str_pad($sale['id'], 6, '0', STR_PAD_LEFT) : '000000' ?> | HISONA STORE</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Courier New', monospace;
        }
        
        .receipt-container {
            max-width: 400px;
            width: 100%;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .store-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #e2e8f0;
        }
        
        .store-name {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #1a202c;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .store-address, .store-contact {
            font-size: 11px;
            color: #64748b;
        }
        
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 12px;
        }
        
        .receipt-label {
            font-weight: 600;
            color: #64748b;
        }
        
        .receipt-value {
            color: #1e293b;
        }
        
        .divider {
            border-top: 1px dashed #cbd5e0;
            margin: 12px 0;
        }
        
        .items-table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
            font-size: 12px;
        }
        
        .items-table th {
            padding: 8px 2px;
            font-weight: 600;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        
        .items-table td {
            padding: 6px 2px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .total-row {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #e2e8f0;
        }
        
        .total-label {
            font-weight: bold;
            font-size: 14px;
        }
        
        .total-amount {
            font-weight: bold;
            font-size: 14px;
            color: #10b981;
            text-align: right;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 12px;
        }
        
        .thank-you {
            text-align: center;
            margin: 20px 0;
            padding-top: 15px;
            border-top: 2px dashed #e2e8f0;
        }
        
        .thank-you-text {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
        }
        
        .thank-you-subtext {
            font-size: 11px;
            color: #64748b;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .btn {
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        
        .btn-print {
            background: #3b82f6;
            color: white;
        }
        
        .btn-print:hover {
            background: #2563eb;
        }
        
        .btn-back {
            background: #64748b;
            color: white;
        }
        
        .btn-back:hover {
            background: #475569;
        }
        
        .btn-new {
            background: #10b981;
            color: white;
        }
        
        .btn-new:hover {
            background: #059669;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .receipt-container {
                box-shadow: none;
                border-radius: 0;
                padding: 15px;
                max-width: 100%;
            }
            .action-buttons {
                display: none !important;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="receipt-container">
    
    <!-- Store Header -->
    <div class="store-header">
        <div class="store-name">HISONA STORE</div>
        <div class="store-address">Brgy. Tabugon, Kabankalan City</div>
        <div class="store-contact">Tel: 0912-345-6789</div>
    </div>
    
    <!-- Receipt Details -->
    <div class="receipt-info">
        <span class="receipt-label">Receipt No.:</span>
        <span class="receipt-value"><?= isset($sale['id']) ? str_pad($sale['id'], 8, '0', STR_PAD_LEFT) : 'N/A' ?></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Date:</span>
        <span class="receipt-value"><?= isset($sale['date']) ? date('Y-m-d', strtotime($sale['date'])) : date('Y-m-d') ?></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Time:</span>
        <span class="receipt-value"><?= isset($sale['date']) ? date('h:i A', strtotime($sale['date'])) : date('h:i A') ?></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Cashier:</span>
        <span class="receipt-value"><?= session()->get('username') ?? 'Admin' ?></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Payment:</span>
        <span class="receipt-value"><?= ucfirst($sale['payment_method'] ?? 'Cash') ?></span>
    </div>
    
    <div class="divider"></div>
    
    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($items) && is_array($items)): ?>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?= esc($item['name'] ?? '—') ?></td>
                    <td class="text-center"><?= $item['quantity'] ?? 0 ?></td>
                    <td class="text-right">₱<?= number_format($item['subtotal'] ?? 0, 2) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">— No items —</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="divider"></div>
    
    <!-- Totals -->
    <div class="payment-row">
        <span class="receipt-label">TOTAL:</span>
        <span class="total-amount">₱<?= number_format($total ?? 0, 2) ?></span>
    </div>
    <div class="payment-row">
        <span class="receipt-label">Amount Tendered:</span>
        <span>₱<?= number_format($sale['amount_received'] ?? $total ?? 0, 2) ?></span>
    </div>
    <div class="payment-row">
        <span class="receipt-label">Change:</span>
        <span class="text-success">₱<?= number_format($sale['change_amount'] ?? 0, 2) ?></span>
    </div>
    
    <!-- Thank You -->
    <div class="thank-you">
        <div class="thank-you-text">Thank You for Your Purchase!</div>
        <div class="thank-you-subtext">We appreciate your business. 😊</div>
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons no-print">
        <button class="btn btn-back" onclick="goBack()">
            ⬅️ Back
        </button>
        <button class="btn btn-print" onclick="window.print()">
            🖨️ Print
        </button>
        <button class="btn btn-new" onclick="newTransaction()">
            🆕 New Transaction
        </button>
    </div>
    
</div>

<script>
// Back button - close tab or go back
function goBack() {
    // Try to close the tab
    window.close();
    
    // Fallback: go to previous page
    setTimeout(function() {
        window.location.href = '<?= base_url('sales_items') ?>';
    }, 100);
}

// New transaction - close current and open new POS
function newTransaction() {
    // Try to close the tab
    window.close();
    
    // Fallback: go to new transaction
    setTimeout(function() {
        window.location.href = '<?= base_url('sales_items/new') ?>';
    }, 100);
}

// Handle back button press
history.pushState(null, null, location.href);
window.onpopstate = function() {
    goBack();
};
</script>

</body>
</html>