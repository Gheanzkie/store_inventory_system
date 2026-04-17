<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Receipt #<?= str_pad($sale['id'], 6, '0', STR_PAD_LEFT) ?> | HISONA STORE</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
            padding: 30px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .receipt-container {
            max-width: 420px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            position: relative;
        }
        
        .store-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px dashed #e9ecef;
            padding-bottom: 15px;
        }
        
        .store-name {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        .store-address {
            font-size: 13px;
            color: #718096;
            margin: 0;
            line-height: 1.5;
        }
        
        .store-contact {
            font-size: 13px;
            color: #718096;
            margin: 0;
        }
        
        .divider {
            border-top: 1px dashed #cbd5e0;
            margin: 15px 0;
        }
        
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .receipt-label {
            font-weight: 600;
            color: #4a5568;
        }
        
        .receipt-value {
            color: #2d3748;
        }
        
        .items-table {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .items-table thead {
            background: #f7fafc;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .items-table th {
            padding: 10px 5px;
            font-weight: 600;
            color: #4a5568;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        
        .items-table td {
            padding: 8px 5px;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
        }
        
        .items-table tfoot {
            background: #f7fafc;
            border-top: 2px solid #e2e8f0;
            font-weight: 700;
        }
        
        .items-table tfoot td {
            padding: 12px 5px;
            font-size: 15px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .total-row {
            background: #e6fffa;
            color: #234e52;
        }
        
        .payment-summary {
            margin: 15px 0;
            padding: 10px 0;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 14px;
        }
        
        .payment-label {
            font-weight: 600;
            color: #4a5568;
        }
        
        .payment-value {
            font-weight: 600;
            color: #2d3748;
        }
        
        .change-value {
            color: #38a169;
            font-size: 16px;
        }
        
        .thank-you {
            text-align: center;
            margin: 20px 0 15px;
            padding-top: 10px;
            border-top: 2px dashed #e9ecef;
        }
        
        .thank-you-text {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin: 0 0 5px 0;
        }
        
        .thank-you-subtext {
            font-size: 13px;
            color: #718096;
            margin: 0;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
        }
        
        .btn {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .btn-primary {
            background: #4299e1;
            color: white;
            box-shadow: 0 2px 4px rgba(66, 153, 225, 0.2);
        }
        
        .btn-primary:hover {
            background: #3182ce;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(66, 153, 225, 0.3);
        }
        
        .btn-secondary {
            background: #a0aec0;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #718096;
            color: white;
            text-decoration: none;
        }
        
        .btn-success {
            background: #48bb78;
            color: white;
            box-shadow: 0 2px 4px rgba(72, 187, 120, 0.2);
        }
        
        .btn-success:hover {
            background: #38a169;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(72, 187, 120, 0.3);
        }
        
        .receipt-badge {
            display: inline-block;
            background: #e2e8f0;
            color: #4a5568;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
                display: block;
            }
            
            .receipt-container {
                box-shadow: none;
                border-radius: 0;
                padding: 20px;
                max-width: 100%;
            }
            
            .no-print {
                display: none !important;
            }
            
            .action-buttons {
                display: none;
            }
            
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        
        
        <div class="store-header">
            <h1 class="store-name">HISONA STORE</h1>
            <p class="store-address">Brgy. Tabugon, Kabankalan City</p>
            <p class="store-contact">Tel: 0912-345-6789</p>
        </div>
        
        
        <div class="text-center">
            <span class="receipt-badge">
                <i class="fas fa-receipt mr-1"></i> OFFICIAL RECEIPT
            </span>
        </div>
        
        
        <div class="receipt-info">
            <span class="receipt-label">Receipt No.:</span>
            <span class="receipt-value"><strong><?= str_pad($sale['id'], 8, '0', STR_PAD_LEFT) ?></strong></span>
        </div>
        
        <div class="receipt-info">
            <span class="receipt-label">Date:</span>
            <span class="receipt-value"><?= date('F d, Y', strtotime($sale['date'])) ?></span>
        </div>
        
        <div class="receipt-info">
            <span class="receipt-label">Time:</span>
            <span class="receipt-value"><?= date('h:i A', strtotime($sale['date'])) ?></span>
        </div>
        
        <div class="receipt-info">
            <span class="receipt-label">Payment Method:</span>
            <span class="receipt-value"><?= ucfirst($sale['payment_method'] ?? 'Cash') ?></span>
        </div>
        
        <div class="divider"></div>
        
        
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Price</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td class="text-right">₱<?= number_format($item['price'], 2) ?></td>
                    <td class="text-center"><?= $item['quantity'] ?></td>
                    <td class="text-right">₱<?= number_format($item['subtotal'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                    <td class="text-right"><strong>₱<?= number_format($total, 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="divider"></div>
        
        
        <div class="payment-summary">
            <div class="payment-row">
                <span class="payment-label">Amount Tendered:</span>
                <span class="payment-value">₱<?= number_format($sale['amount_received'] ?? $total, 2) ?></span>
            </div>
            <div class="payment-row">
                <span class="payment-label">Change Due:</span>
                <span class="payment-value change-value">₱<?= number_format($sale['change_amount'] ?? 0, 2) ?></span>
            </div>
        </div>
        
        <div class="thank-you">
            <p class="thank-you-text">Thank You for Your Purchase!</p>
            <p class="thank-you-subtext">We appreciate your business. Have a wonderful day! 😊</p>
        </div>
        
        
        <div class="action-buttons no-print">
            <a href="<?= base_url('sales') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print"></i> Print Receipt
            </button>
            <a href="<?= base_url('sales_items/create') ?>" class="btn btn-success">
                <i class="fas fa-plus"></i> New Transaction
            </a>
        </div>
        
    </div>
    
    <script>
        // Auto-print on load if needed (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>