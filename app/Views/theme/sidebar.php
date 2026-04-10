<style>

.nav-sidebar .nav-link {
    position: relative;
    transition: background 0.2s ease;
}

.nav-sidebar .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: orange;
    border-radius: 0 3px 3px 0;
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.25s ease;
}

.nav-sidebar .nav-link.active::before,
.nav-sidebar .nav-link:hover::before {
    transform: scaleY(1);
}


.nav-sidebar .nav-link:hover,
.nav-sidebar .nav-link.active {
    background: linear-gradient(
        to right,
        rgba(255, 165, 0, 0.05),
        rgba(255, 165, 0, 0.01)
    ) !important;
    box-shadow: none !important;
}


.nav-treeview .nav-link:hover,
.nav-treeview .nav-link.active {
    background: linear-gradient(
        to right,
        rgba(255, 165, 0, 0.05),
        rgba(255, 165, 0, 0.01)
    ) !important;
    box-shadow: none !important;
}


body.dark-mode .main-sidebar .nav-link,
body.dark-mode .main-sidebar .nav-link p,
body.dark-mode .main-sidebar .nav-icon {
    color: #fff !important;
}

body.dark-mode .main-sidebar .nav-link.active,
body.dark-mode .main-sidebar .nav-link:hover {
    background-color: rgba(255, 165, 0, 0.1) !important; /* subtle orange bg */
}
</style>


<aside class="main-sidebar sidebar-light-light elevation-5" id="mainSidebar">
    <div class="brand-link bg-warning" style="cursor: default; border-bottom: 1px solid rgba(0,0,0,0.1);">
        <img src="<?= base_url('assets/img/store.jpg') ?>" 
             alt="Logo" 
             class="brand-image img-circle elevation-3" 
             style="opacity: 1;">
        <span class="brand-text font-weight-bold" style="color: Blue;">Hisona Store</span>
    </div>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" 
                data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" 
                    class="nav-link <?= is_active(1, 'dashboard') ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                    </a>
                </li>

                <?php if(session()->get('role') === 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('log') ?>" class="nav-link <?= is_active(1,'log') ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
                <?php endif; ?>

                

                <li class="nav-item">
                    <a href="<?= base_url('sales') ?>" 
                    class="nav-link <?= is_active(1, 'sales') ?>">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>Sales</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('product') ?>" 
                    class="nav-link <?= is_active(1, 'product') ?>">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>Product Management</p>
                    </a>
                </li>

                <?php if(session()->get('role') === 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('users') ?>" class="nav-link <?= is_active(1,'users') ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Account Management</p>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>