<style>

/* ================= SIDEBAR DESIGN ================= */

.nav-sidebar .nav-link {
    position: relative;
    transition: all 0.2s ease;
    border-radius: 6px;
    margin: 2px 6px;
    padding: 10px 12px;
}

/* LEFT ORANGE ACTIVE BAR */
.nav-sidebar .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    top: 20%;
    height: 60%;
    width: 4px;
    background: orange;
    border-radius: 0 4px 4px 0;
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.25s ease;
}

.nav-sidebar .nav-link.active::before,
.nav-sidebar .nav-link:hover::before {
    transform: scaleY(1);
}

/* HOVER EFFECT */
.nav-sidebar .nav-link:hover,
.nav-sidebar .nav-link.active {
    background: linear-gradient(
        to right,
        rgba(255, 165, 0, 0.08),
        rgba(255, 165, 0, 0.01)
    ) !important;
    transform: translateX(3px);
}

/* ICON COLOR */
.nav-sidebar .nav-icon {
    margin-right: 6px;
    color: #ff9800;
}

/* TREE VIEW */
.nav-treeview .nav-link {
    padding-left: 25px;
}

/* DARK MODE */
body.dark-mode .main-sidebar {
    background-color: #1e1e2f !important;
}

body.dark-mode .main-sidebar .nav-link,
body.dark-mode .main-sidebar .nav-link p,
body.dark-mode .main-sidebar .nav-icon {
    color: #e0e0e0 !important;
}

body.dark-mode .main-sidebar .nav-link.active,
body.dark-mode .main-sidebar .nav-link:hover {
    background-color: rgba(255, 165, 0, 0.12) !important;
}

/* BRAND */
.brand-link {
    display: flex;
    align-items: center;
    gap: 10px;
}

.brand-link span {
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

</style>

<aside class="main-sidebar sidebar-light-light elevation-5" id="mainSidebar">

    <div class="brand-link bg-warning" id="brandLink"
         style="cursor: default; border-bottom: 1px solid rgba(0,0,0,0.1);">

        <img src="<?= base_url('assets/img/store.jpg') ?>" 
             class="brand-image img-circle elevation-3">

        <span class="brand-text">Hisona Store POS</span>
    </div>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>"
                    class="nav-link <?= is_active(1, 'dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if(session()->get('role') === 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('log') ?>"
                    class="nav-link <?= is_active(1,'log') ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?= base_url('sales') ?>"
                    class="nav-link <?= is_active(1, 'sales') ?>">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Sales</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('sales_items') ?>"
                    class="nav-link <?= is_active(1, 'sales_items') ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Transactions</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('product') ?>"
                    class="nav-link <?= is_active(1, 'product') ?>">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Products</p>
                    </a>
                </li>

                <?php if(session()->get('role') === 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('users') ?>"
                    class="nav-link <?= is_active(1,'users') ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Accounts</p>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>