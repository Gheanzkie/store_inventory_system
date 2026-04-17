<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-history mr-2"></i>Activity Logs
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Activity Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-2">
                                    <i class="fas fa-clipboard-list mr-2"></i>System Activity
                                </h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Date Filter -->
                                    <form id="dateFilterForm" method="get" class="form-inline mr-2">
                                        <input type="hidden" name="filter" value="<?= esc($selectedFilter ?? 'all') ?>">
                                        <div class="input-group input-group-sm shadow-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0">
                                                    <i class="fas fa-calendar-alt text-muted"></i>
                                                </span>
                                            </div>
                                            <input type="date" name="date" id="filterDate"
                                                   class="form-control border-left-0 shadow-none" 
                                                   value="<?= esc($selectedDate ?? date('Y-m-d')) ?>">
                                        </div>
                                    </form>
                                    
                                    <!-- Quick Filters -->
                                    <div class="btn-group btn-group-sm">
                                        <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=all" 
                                           class="btn <?= ($selectedFilter ?? 'all') == 'all' ? 'btn-secondary' : 'btn-outline-secondary' ?>">
                                            All
                                        </a>
                                        <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=products" 
                                           class="btn <?= ($selectedFilter ?? '') == 'products' ? 'btn-secondary' : 'btn-outline-secondary' ?>">
                                            <i class="fas fa-box mr-1"></i>Products
                                        </a>
                                        <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=staff" 
                                           class="btn <?= ($selectedFilter ?? '') == 'staff' ? 'btn-secondary' : 'btn-outline-secondary' ?>">
                                            <i class="fas fa-users mr-1"></i>Staff
                                        </a>
                                        <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=sales" 
                                           class="btn <?= ($selectedFilter ?? '') == 'sales' ? 'btn-secondary' : 'btn-outline-secondary' ?>">
                                            <i class="fas fa-shopping-cart mr-1"></i>Sales
                                        </a>
                                        <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=login" 
                                           class="btn <?= ($selectedFilter ?? '') == 'login' ? 'btn-secondary' : 'btn-outline-secondary' ?>">
                                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Operation Type Filters -->
                            <div class="mt-2 d-flex flex-wrap gap-2">
                                <span class="text-muted small mr-2">Operation:</span>
                                <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=add" 
                                   class="badge <?= ($selectedFilter ?? '') == 'add' ? 'badge-success' : 'badge-light' ?> px-3 py-2">
                                    <i class="fas fa-plus-circle mr-1"></i>Add
                                </a>
                                <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=update" 
                                   class="badge <?= ($selectedFilter ?? '') == 'update' ? 'badge-warning' : 'badge-light' ?> px-3 py-2">
                                    <i class="fas fa-edit mr-1"></i>Update
                                </a>
                                <a href="?date=<?= $selectedDate ?? date('Y-m-d') ?>&filter=delete" 
                                   class="badge <?= ($selectedFilter ?? '') == 'delete' ? 'badge-danger' : 'badge-light' ?> px-3 py-2">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body pt-0">
                            
                            <!-- Stats Summary -->
                            <?php if (!empty($logs)): ?>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="text-muted small">
                                            <i class="fas fa-list mr-1"></i><?= count($logs) ?> activities
                                        </span>
                                        <span class="text-success small">
                                            <i class="fas fa-plus-circle mr-1"></i>
                                            <?= count(array_filter($logs, fn($l) => ($l['identifier'] ?? '') == 'ADD' || strpos(strtolower($l['ACTION'] ?? ''), 'added') !== false)) ?> adds
                                        </span>
                                        <span class="text-warning small">
                                            <i class="fas fa-edit mr-1"></i>
                                            <?= count(array_filter($logs, fn($l) => ($l['identifier'] ?? '') == 'UPDATE' || strpos(strtolower($l['ACTION'] ?? ''), 'updated') !== false)) ?> updates
                                        </span>
                                        <span class="text-danger small">
                                            <i class="fas fa-trash-alt mr-1"></i>
                                            <?= count(array_filter($logs, fn($l) => ($l['identifier'] ?? '') == 'DELETE' || strpos(strtolower($l['ACTION'] ?? ''), 'deleted') !== false)) ?> deletes
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($logs)): ?>
                            <div class="timeline">
                                <?php 
                                $currentDate = '';
                                foreach ($logs as $log): 
                                    $logDate = $log['DATELOG'];
                                    if ($logDate != $currentDate):
                                        $currentDate = $logDate;
                                ?>
                                <!-- Date Separator -->
                                <div class="time-label">
                                    <span class="badge badge-light text-secondary px-4 py-2 shadow-sm">
                                        <i class="far fa-calendar-alt mr-2"></i><?= esc($logDate) ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Timeline Item -->
                                <div class="timeline-item-wrapper">
                                    <i class="fas fa-circle timeline-icon 
                                        <?= ($log['identifier'] ?? '') == 'LOGIN' ? 'text-success' : 
                                           (($log['identifier'] ?? '') == 'LOGOUT' ? 'text-warning' : 
                                           (($log['identifier'] ?? '') == 'DELETE' ? 'text-danger' : 
                                           (($log['identifier'] ?? '') == 'ADD' ? 'text-success' :
                                           (($log['identifier'] ?? '') == 'UPDATE' ? 'text-warning' : 'text-info')))) ?>">
                                    </i>
                                    <div class="timeline-item bg-white shadow-sm border-0 rounded-lg p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="time">
                                                <i class="far fa-clock mr-1 text-muted"></i>
                                                <span class="text-muted"><?= esc(date('h:i A', strtotime($log['TIMELOG']))) ?></span>
                                            </span>
                                            <?php 
                                            $identifier = $log['identifier'] ?? '';
                                            $badgeClass = 'badge-info';
                                            if ($identifier == 'LOGIN' || $identifier == 'ADD') $badgeClass = 'badge-success';
                                            elseif ($identifier == 'LOGOUT') $badgeClass = 'badge-warning';
                                            elseif ($identifier == 'DELETE') $badgeClass = 'badge-danger';
                                            elseif ($identifier == 'UPDATE') $badgeClass = 'badge-warning';
                                            ?>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= esc($identifier ?: 'ACTION') ?>
                                            </span>
                                        </div>
                                        
                                        <h6 class="font-weight-medium text-secondary mb-2">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            <?= esc($log['USER_NAME'] ?: 'System') ?>
                                            <?php if ($log['USERID']): ?>
                                                <small class="text-muted ml-1">(ID: <?= esc($log['USERID']) ?>)</small>
                                            <?php endif; ?>
                                        </h6>
                                        
                                        <p class="timeline-body text-secondary mb-2">
                                            <i class="fas fa-tasks mr-2"></i>
                                            <strong>Action:</strong> <?= esc($log['ACTION']) ?>
                                        </p>
                                        
                                        <div class="row small text-muted">
                                            <div class="col-md-6">
                                                <i class="fas fa-globe mr-1"></i>
                                                <?= esc($log['user_ip_address'] ?: '—') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <i class="fas fa-laptop mr-1"></i>
                                                <?= esc(substr($log['device_used'] ?: '—', 0, 50)) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                
                                <!-- End Indicator -->
                                <div class="timeline-end">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span class="text-muted small ml-2">End of logs</span>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-clipboard fa-4x mb-3 opacity-50"></i>
                                <h5 class="font-weight-normal">No activity logs found</h5>
                                <p class="small">No system activity recorded for this filter.</p>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('filterDate').addEventListener('change', function () {
    document.getElementById('dateFilterForm').submit();
});
</script>

<style>
.card { border-radius: 10px; }
.timeline { position: relative; padding-left: 30px; }
.timeline-item-wrapper { position: relative; margin-bottom: 5px; }
.timeline-icon { 
    position: absolute; left: -35px; top: 18px; 
    font-size: 10px; background: white; padding: 3px;
    border-radius: 50%; box-shadow: 0 0 0 3px #f3f4f6;
}
.timeline-item { 
    margin-left: 0; 
    transition: all 0.2s ease;
}
.timeline-item:hover {
    transform: translateX(3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08) !important;
}
.time-label { text-align: center; margin: 20px 0 15px -30px; }
.time-label span { font-weight: 500; }
.timeline-end { margin: 15px 0 10px -5px; }
.timeline-body { margin-bottom: 8px; }
.font-weight-medium { font-weight: 500; }
.opacity-50 { opacity: 0.5; }
.rounded-lg { border-radius: 12px !important; }
.gap-2 { gap: 0.5rem; }
.gap-3 { gap: 1rem; }

/* Color indicators */
.badge-success { background: #10b981; color: white; }
.badge-warning { background: #f59e0b; color: white; }
.badge-danger { background: #ef4444; color: white; }
.badge-info { background: #3b82f6; color: white; }
.badge-light { background: #f3f4f6; color: #4b5563; }
.text-success { color: #10b981 !important; }
.text-warning { color: #f59e0b !important; }
.text-danger { color: #ef4444 !important; }
.text-info { color: #3b82f6 !important; }

/* Input styling */
.form-control:focus, .shadow-none:focus { 
    box-shadow: none; 
    border-color: #9ca3af; 
}
.input-group-text { border: 1px solid #e5e7eb; }
.btn-secondary { background: #6b7280; border-color: #6b7280; }
.btn-secondary:hover { background: #4b5563; border-color: #4b5563; }
.btn-outline-secondary { border-color: #d1d5db; color: #4b5563; }
.btn-outline-secondary:hover { background: #f3f4f6; border-color: #9ca3af; color: #374151; }
</style>
<?= $this->endSection() ?>