<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #<?= str_pad($sale['id'], 6, '0', STR_PAD_LEFT) ?> | HISONA STORE</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', 'Inter', sans-serif;
            padding: 30px 20px;
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .receipt-container {
            max-width: 420px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .store-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 2px dashed #e2e8f0;
        }
        
        .store-name {
            font-size: 26px;
            font-weight: 700;
            color: #1a202c;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .store-address, .store-contact {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }
        
        .receipt-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #475569;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
        }
        
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .receipt-label {
            font-weight: 600;
            color: #64748b;
        }
        
        .receipt-value {
            color: #1e293b;
            font-weight: 500;
        }
        
        .divider {
            border-top: 1px dashed #cbd5e0;
            margin: 18px 0;
        }
        
        .items-table {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .items-table thead {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .items-table th {
            padding: 12px 5px;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        
        .items-table td {
            padding: 10px 5px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }
        
        .items-table tfoot {
            background: #f8fafc;
            border-top: 2px solid #e2e8f0;
            font-weight: 700;
        }
        
        .items-table tfoot td {
            padding: 14px 5px;
            font-size: 15px;
        }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .total-row {
            background: #10b98110;
            color: #047857;
        }
        
        .payment-summary {
            margin: 18px 0;
            padding: 12px 0;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 14px;
        }
        
        .payment-label {
            font-weight: 600;
            color: #64748b;
        }
        
        .payment-value {
            font-weight: 600;
            color: #1e293b;
        }
        
        .change-value {
            color: #10b981;
            font-size: 18px;
            font-weight: 700;
        }
        
        .thank-you {
            text-align: center;
            margin: 25px 0 20px;
            padding-top: 18px;
            border-top: 2px dashed #e2e8f0;
        }
        
        .thank-you-text {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }
        
        .thank-you-subtext {
            font-size: 13px;
            color: #64748b;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
        }
        
        .btn {
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
        }
        
        .btn-primary {
            background: #3b82f6;
            color: #fff;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        }
        
        .btn-primary:hover {
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary {
            background: #64748b;
            color: #fff;
        }
        
        .btn-secondary:hover {
            background: #475569;
            color: #fff;
            text-decoration: none;
        }
        
        .btn-success {
            background: #10b981;
            color: #fff;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
        }
        
        .btn-success:hover {
            background: #059669;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        @media print {
            body { background: #fff; padding: 0; }
            .receipt-container { box-shadow: none; border-radius: 0; }
            .no-print, .action-buttons, .btn { display: none !important; }
        }
    </style>
</head>
<body>
<div class="receipt-container">
    
    <!-- Store Header -->
    <div class="store-header">
        <h1 class="store-name">HISONA STORE</h1>
        <p class="store-address">Brgy. Tabugon, Kabankalan City</p>
        <p class="store-contact">Tel: 0912-345-6789</p>
    </div>
    
    <!-- Receipt Badge -->
    <div class="text-center">
        <span class="receipt-badge">
            <i class="fas fa-receipt mr-1"></i> OFFICIAL RECEIPT
        </span>
    </div>
    
    <!-- Receipt Details -->
    <div class="receipt-info">
        <span class="receipt-label">Receipt No.</span>
        <span class="receipt-value"><strong><?= str_pad($sale['id'], 8, '0', STR_PAD_LEFT) ?></strong></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Date</span>
        <span class="receipt-value"><?= date('F d, Y', strtotime($sale['date'])) ?></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Time</span>
        <span class="receipt-value"><?= date('h:i A', strtotime($sale['date'])) ?></span>
    </div>
    <div class="receipt-info">
        <span class="receipt-label">Payment</span>
        <span class="receipt-value"><?= ucfirst($sale['payment_method'] ?? 'Cash') ?></span>
    </div>
    
    <div class="divider"></div>
    
    <!-- Items Table -->
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
    
    <!-- Payment Summary -->
    <div class="payment-summary">
        <div class="payment-row">
            <span class="payment-label">Amount Tendered</span>
            <span class="payment-value">₱<?= number_format($sale['amount_received'] ?? $total, 2) ?></span>
        </div>
        <div class="payment-row">
            <span class="payment-label">Change Due</span>
            <span class="change-value">₱<?= number_format($sale['change_amount'] ?? 0, 2) ?></span>
        </div>
    </div>
    
    <!-- Thank You -->
    <div class="thank-you">
        <p class="thank-you-text">Thank You for Your Purchase!</p>
        <p class="thank-you-subtext">We appreciate your business. Have a wonderful day! 😊</p>
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons no-print">
        <a href="<?= base_url('sales') ?>" class="btn btn-secondary">
            <i class="fas fa-history"></i> History
        </a>
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i> Print
        </button>
        <a href="<?= base_url('sales_items/new') ?>" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> New
        </a>
    </div>
    
</div>
</body>
</html>