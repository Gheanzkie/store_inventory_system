<style>
/* ================= SIDEBAR DESIGN - PROFESSIONAL THEME ================= */

/* Main Sidebar Background */
.main-sidebar {
    background: linear-gradient(180deg, #1a202c 0%, #2d3748 100%) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
}

/* Brand Section */
.brand-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 12px !important;
    background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%) !important;
    border-bottom: 1px solid rgba(255, 193, 7, 0.2) !important;
    transition: all 0.3s ease;
}

.brand-image {
    width: 40px !important;
    height: 40px !important;
    border: 2px solid #ffc107;
    box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    object-fit: cover;
}

.brand-text {
    font-size: 18px !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px;
    color: #ffffff !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

/* Navigation Links */
.nav-sidebar .nav-link {
    position: relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 8px;
    margin: 3px 8px;
    padding: 12px 15px;
    color: rgba(255, 255, 255, 0.75) !important;
    font-weight: 500;
    overflow: hidden;
}

/* Active Indicator Bar */
.nav-sidebar .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    top: 15%;
    height: 70%;
    width: 4px;
    background: linear-gradient(180deg, #ffc107 0%, #ff9800 100%);
    border-radius: 0 4px 4px 0;
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 0 8px rgba(255, 193, 7, 0.5);
}

.nav-sidebar .nav-link.active::before,
.nav-sidebar .nav-link:hover::before {
    transform: scaleY(1);
}

/* Hover and Active States */
.nav-sidebar .nav-link:hover,
.nav-sidebar .nav-link.active {
    background: linear-gradient(90deg, rgba(255, 193, 7, 0.12) 0%, rgba(255, 193, 7, 0.02) 100%) !important;
    transform: translateX(5px);
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Glow effect on hover */
.nav-sidebar .nav-link:hover {
    box-shadow: 0 2px 12px rgba(255, 193, 7, 0.15);
}

/* Icon Styling */
.nav-sidebar .nav-icon {
    margin-right: 12px;
    color: #ffc107 !important;
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
    transition: all 0.3s ease;
    filter: drop-shadow(0 0 4px rgba(255, 193, 7, 0.3));
}

.nav-sidebar .nav-link:hover .nav-icon,
.nav-sidebar .nav-link.active .nav-icon {
    transform: scale(1.1);
    color: #ffc107 !important;
}

/* Text Styling */
.nav-sidebar .nav-link p {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
    color: inherit;
}

/* Tree View (Submenu) */
.nav-treeview {
    background: rgba(0, 0, 0, 0.15) !important;
    margin: 0 8px !important;
    border-radius: 8px;
    padding: 5px 0;
}

.nav-treeview .nav-link {
    padding-left: 35px !important;
    font-size: 13px;
    margin: 2px 5px;
}

.nav-treeview .nav-link::before {
    width: 3px;
    background: #ff9800;
}

.nav-treeview .nav-icon {
    font-size: 0.9rem;
    margin-right: 8px;
}

/* Divider */
.nav-sidebar .nav-item:not(:last-child) {
    margin-bottom: 2px;
}

/* Scrollbar Styling */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 193, 7, 0.3);
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 193, 7, 0.5);
}

/* Dark Mode Support */
body.dark-mode .main-sidebar {
    background: linear-gradient(180deg, #0f141e 0%, #1a2332 100%) !important;
}

body.dark-mode .brand-link {
    background: linear-gradient(135deg, #1a2332 0%, #0f141e 100%) !important;
}

body.dark-mode .nav-sidebar .nav-link {
    color: rgba(255, 255, 255, 0.7) !important;
}

body.dark-mode .nav-sidebar .nav-link:hover,
body.dark-mode .nav-sidebar .nav-link.active {
    background: linear-gradient(90deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0.03) 100%) !important;
    color: #ffffff !important;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .brand-text {
        font-size: 16px !important;
    }
    
    .nav-sidebar .nav-link {
        padding: 10px 12px;
    }
}

/* Animation for sidebar items */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.nav-sidebar .nav-item {
    animation: slideIn 0.4s ease-out forwards;
    opacity: 0;
}

.nav-sidebar .nav-item:nth-child(1) { animation-delay: 0.05s; }
.nav-sidebar .nav-item:nth-child(2) { animation-delay: 0.1s; }
.nav-sidebar .nav-item:nth-child(3) { animation-delay: 0.15s; }
.nav-sidebar .nav-item:nth-child(4) { animation-delay: 0.2s; }
.nav-sidebar .nav-item:nth-child(5) { animation-delay: 0.25s; }
.nav-sidebar .nav-item:nth-child(6) { animation-delay: 0.3s; }
.nav-sidebar .nav-item:nth-child(7) { animation-delay: 0.35s; }
.nav-sidebar .nav-item:nth-child(8) { animation-delay: 0.4s; }

</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4" id="mainSidebar">

    <!-- Brand Logo -->
    <div class="brand-link" id="brandLink">
        <img src="<?= base_url('assets/img/store.jpg') ?>" 
             alt="Hisona Store Logo"
             class="brand-image img-circle">
        <span class="brand-text font-weight-bold">HISONA STORE</span>
    </div>

    <!-- Sidebar Content -->
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" 
                       class="nav-link <?= is_active(1, 'dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Point of Sale -->
                <li class="nav-item">
                    <a href="<?= base_url('sales_items') ?>" 
                       class="nav-link <?= is_active(1, 'sales_items') ?>">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Point of Sale</p>
                    </a>
                </li>

                <!-- Transactions -->
                <li class="nav-item">
                    <a href="<?= base_url('sales') ?>" 
                       class="nav-link <?= is_active(1, 'sales') ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Transactions</p>
                    </a>
                </li>

                <!-- Products -->
                <li class="nav-item">
                    <a href="<?= base_url('product') ?>" 
                       class="nav-link <?= is_active(1, 'product') ?>">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Products</p>
                    </a>
                </li>

                <!-- Admin Only Section -->
                <?php if(session()->get('role') === 'admin'): ?>
                
                <!-- Divider -->
                <li class="nav-header">
                    <span class="text-uppercase text-white-50 font-weight-bold px-3" 
                          style="font-size: 0.7rem; letter-spacing: 1px;">
                        Administration
                    </span>
                </li>

                <!-- Staff Accounts -->
                <li class="nav-item">
                    <a href="<?= base_url('users') ?>" 
                       class="nav-link <?= is_active(1, 'users') ?>">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Staff Accounts</p>
                    </a>
                </li>

                <!-- Activity Logs -->
                <li class="nav-item">
                    <a href="<?= base_url('log') ?>" 
                       class="nav-link <?= is_active(1, 'log') ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Divider -->
                <li class="nav-header mt-3">
                    <span class="text-uppercase text-white-50 font-weight-bold px-3" 
                          style="font-size: 0.7rem; letter-spacing: 1px;">
                        VERSION
                    </span>
                </li>

                <!-- Settings -->
                <li class="nav-item " style="text-align: center;">
                        <p class="text-white" style="opacity: 40%;">v1.2</p>

                </li>

            </ul>
        </nav>
        
        <!-- Sidebar Footer -->
        <div class="mt-auto p-3 text-center" style="position: absolute; bottom: 0; width: 100%;">
            <small class="text-white-50">
                <i class="far fa-clock mr-1"></i> 
                <span id="currentTime"></span>
            </small>
        </div>
    </div>
</aside>

<script>
// Update time in sidebar footer
function updateSidebarTime() {
    const now = new Date();
    const timeStr = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit',
        hour12: true 
    });
    const dateStr = now.toLocaleDateString('en-US', { 
        month: 'short', 
        day: 'numeric', 
        year: 'numeric' 
    });
    
    const timeElement = document.getElementById('currentTime');
    if (timeElement) {
        timeElement.innerHTML = dateStr + ' ' + timeStr;
    }
}

// Update every second
setInterval(updateSidebarTime, 1000);
updateSidebarTime();
</script>