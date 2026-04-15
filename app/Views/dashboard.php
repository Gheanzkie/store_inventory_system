<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Summary Cards Row 1 -->
            <div class="row">
                <!-- Sales Today -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Sales Today</span>
                            <span class="info-box-number font-weight-bold">₱<?= number_format($todaySales ?? 0, 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Sales This Month -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Sales This Month</span>
                            <span class="info-box-number font-weight-bold">₱<?= number_format($monthSales ?? 0, 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Total Transactions -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Total Transactions</span>
                            <span class="info-box-number font-weight-bold"><?= $totalTransactions ?? 0 ?></span>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-warning" style="border-radius: 8px;">
                            <i class="fas fa-clock"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Pending</span>
                            <span class="info-box-number font-weight-bold"><?= $pendingTransactions ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards Row 2 -->
            <div class="row">
                <!-- Total Products -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-boxes"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Total Products</span>
                            <span class="info-box-number font-weight-bold"><?= $totalProducts ?? 0 ?></span>
                        </div>
                    </div>
                </div>

                <!-- Low Stock -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-danger" style="border-radius: 8px;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Low Stock</span>
                            <span class="info-box-number font-weight-bold"><?= $lowStock ?? 0 ?></span>
                        </div>
                    </div>
                </div>

                <!-- Out of Stock -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-dark" style="border-radius: 8px;">
                            <i class="fas fa-ban"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Out of Stock</span>
                            <span class="info-box-number font-weight-bold"><?= $outOfStock ?? 0 ?></span>
                        </div>
                    </div>
                </div>

                <!-- Total Staff -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Total Staff</span>
                            <span class="info-box-number font-weight-bold"><?= $totalStaff ?? 0 ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards Row 3 -->
            <div class="row">
                <!-- Average Sale -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-chart-bar"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Average Sale</span>
                            <span class="info-box-number font-weight-bold">₱<?= number_format($avgSaleValue ?? 0, 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Items Sold Today -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-box"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Items Sold Today</span>
                            <span class="info-box-number font-weight-bold"><?= $todayItemsSold ?? 0 ?></span>
                        </div>
                    </div>
                </div>

                <!-- Transactions Today -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-receipt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Transactions Today</span>
                            <span class="info-box-number font-weight-bold"><?= $todayTransactions ?? 0 ?></span>
                        </div>
                    </div>
                </div>

                <!-- Total Sales All Time -->
                <div class="col-lg-3 col-6">
                    <div class="info-box shadow-sm border-0 bg-white">
                        <span class="info-box-icon bg-white text-secondary" style="border-radius: 8px;">
                            <i class="fas fa-coins"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted">Total Sales</span>
                            <span class="info-box-number font-weight-bold">₱<?= number_format($totalSales ?? 0, 2) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart and Recent Transactions -->
            <div class="row">
                <!-- Sales Chart -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3">
                            <h3 class="card-title font-weight-normal text-secondary mb-0">
                                <i class="fas fa-chart-line mr-2"></i> Sales Overview
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-light text-muted">Last 7 Days</span>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <canvas id="salesChart" style="min-height: 250px; height: 250px; max-height: 250px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3">
                            <h3 class="card-title font-weight-normal text-secondary mb-0">
                                <i class="fas fa-history mr-2"></i> Recent Activity
                            </h3>
                            <div class="card-tools">
                                <a href="<?= base_url('sales') ?>" class="text-muted small">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary">
                                            <th>ID</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($recentTransactions)): ?>
                                            <?php foreach($recentTransactions as $trans): ?>
                                            <tr>
                                                <td class="small">#<?= str_pad($trans['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                                <td class="font-weight-bold small">₱<?= number_format($trans['total'], 2) ?></td>
                                                <td>
                                                    <?php if($trans['status'] == 'completed'): ?>
                                                        <span class="badge badge-success">Done</span>
                                                    <?php elseif($trans['status'] == 'pending'): ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-muted small">
                                                    <?= date('h:i A', strtotime($trans['date'])) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">
                                                    <i class="fas fa-inbox mb-2"></i><br>
                                                    <small>No recent activity</small>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Products and Low Stock -->
            <div class="row">
                <!-- Top Selling Products -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3">
                            <h3 class="card-title font-weight-normal text-secondary mb-0">
                                <i class="fas fa-trophy mr-2"></i> Top Products
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-light text-muted">This Month</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr class="small text-secondary">
                                        <th width="10%">#</th>
                                        <th width="45%">Product</th>
                                        <th width="20%" class="text-center">Sold</th>
                                        <th width="25%" class="text-right">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($topProducts)): ?>
                                        <?php foreach($topProducts as $index => $product): ?>
                                        <tr>
                                            <td class="small font-weight-bold text-muted"><?= $index + 1 ?></td>
                                            <td class="small"><?= esc($product['name']) ?></td>
                                            <td class="small text-center"><?= $product['total_quantity'] ?></td>
                                            <td class="small text-right">₱<?= number_format($product['total_sales'], 2) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="fas fa-chart-bar mb-2"></i><br>
                                                <small>No data available</small>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alert -->
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3">
                            <h3 class="card-title font-weight-normal text-secondary mb-0">
                                <i class="fas fa-exclamation-triangle mr-2"></i> Stock Alert
                            </h3>
                            <div class="card-tools">
                                <a href="<?= base_url('product') ?>" class="text-muted small">
                                    Manage <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr class="small text-secondary">
                                        <th>Product</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($lowStockProducts)): ?>
                                        <?php foreach($lowStockProducts as $product): ?>
                                        <tr>
                                            <td class="small"><?= esc($product['name']) ?></td>
                                            <td class="small text-center"><?= $product['stock'] ?></td>
                                            <td class="small text-right">₱<?= number_format($product['price'], 2) ?></td>
                                            <td class="text-center">
                                                <?php if($product['stock'] == 0): ?>
                                                    <span class="badge badge-danger">Out</span>
                                                <?php elseif($product['stock'] <= 5): ?>
                                                    <span class="badge badge-warning">Low</span>
                                                <?php else: ?>
                                                    <span class="badge badge-info">Low</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="fas fa-check-circle mb-2"></i><br>
                                                <small>All stocked</small>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Chart.js -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
$(document).ready(function() {
    var ctx = document.getElementById('salesChart').getContext('2d');
    
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($chartLabels ?? []) ?>,
            datasets: [{
                label: 'Sales',
                data: <?= json_encode($chartData ?? []) ?>,
                borderColor: '#6b7280',
                backgroundColor: 'rgba(107, 114, 128, 0.05)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#4b5563',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#374151',
                    callbacks: {
                        label: function(context) {
                            return ' ₱' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>

<style>
.info-box {
    border-radius: 10px;
    transition: all 0.2s ease;
    min-height: 90px;
}
.info-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08) !important;
}
.info-box-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.info-box-content {
    padding: 8px 10px;
}
.card {
    border-radius: 10px;
}
.table td, .table th {
    vertical-align: middle;
    border-top: none;
}
.table tbody tr {
    border-bottom: 1px solid #f3f4f6;
}
.table tbody tr:last-child {
    border-bottom: none;
}
.badge {
    font-weight: 400;
    padding: 4px 8px;
}
</style>

<?= $this->endSection() ?>