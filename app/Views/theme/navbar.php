<nav class="main-header navbar navbar-expand navbar-dark shadow-sm"
     style="background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%); border-bottom: 2px solid #4a5568;"
     id="mainNavbar">

    <!-- Left Side -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link text-white px-3" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars fa-lg"></i>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('dashboard') ?>" class="nav-link text-white px-3 font-weight-bold">
                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
            </a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('sales_items') ?>" class="nav-link text-white-50 px-3">
                <i class="fas fa-cash-register mr-1"></i> POS
            </a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('sales') ?>" class="nav-link text-white-50 px-3">
                <i class="fas fa-history mr-1"></i> Transactions
            </a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('product') ?>" class="nav-link text-white-50 px-3">
                <i class="fas fa-boxes mr-1"></i> Products
            </a>
        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('users') ?>" class="nav-link text-white-50 px-3">
                <i class="fas fa-users mr-1"></i> Staff
            </a>
        </li>
    </ul>

    <!-- Right Side -->
    <ul class="navbar-nav ml-auto align-items-center">


        <!-- User Account -->
        <li class="nav-item dropdown">
            <a class="nav-link text-white px-3" data-toggle="dropdown" href="#" role="button">
                <i class="far fa-user-circle fa-lg mr-1"></i>
                <span class="d-none d-md-inline"><?= esc(session()->get('name') ?? 'Admin') ?></span>
                <i class="fas fa-chevron-down ml-1 fa-xs"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <strong><?= esc(session()->get('name') ?? 'Administrator') ?></strong><br>
                    <small class="text-muted"><?= esc(session()->get('role') ?? 'Admin') ?></small>
                </div>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('logout') ?>" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>

    </ul>
</nav>

<!-- Optional CSS for better navbar -->
<style>
    #mainNavbar .nav-link {
        transition: all 0.2s ease;
        border-radius: 6px;
        margin: 0 2px;
    }
    
    #mainNavbar .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff !important;
    }
    
    #mainNavbar .nav-link.text-white-50:hover {
        color: #ffffff !important;
    }
    
    .navbar-badge {
        font-size: 0.6rem !important;
        padding: 2px 5px !important;
        position: absolute;
        top: 5px;
        right: 5px;
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }
    
    .dropdown-header {
        padding: 10px 15px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .dropdown-item {
        padding: 8px 15px;
        transition: all 0.15s ease;
    }
    
    .dropdown-item:hover {
        background: #f8f9fa;
        padding-left: 20px;
    }
    
    .dropdown-item.text-danger:hover {
        background: #fee;
        color: #dc3545 !important;
    }
    
    /* Mobile responsive */
    @media (max-width: 768px) {
        .navbar-nav .nav-link {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
    }
</style>

<script>
// Optional: Theme toggle functionality
document.getElementById('themeToggle')?.addEventListener('click', function() {
    const icon = this.querySelector('i');
    if (icon.classList.contains('fa-sun')) {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
        document.body.classList.add('dark-mode');
    } else {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
        document.body.classList.remove('dark-mode');
    }
});
</script>