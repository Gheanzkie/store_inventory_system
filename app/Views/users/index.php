<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary">
                        <i class="fas fa-users mr-2"></i> Staff Accounts
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Staff</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <div id="alertContainer"></div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title font-weight-normal text-secondary mb-0 mr-3">
                                        <i class="fas fa-user-cog mr-2"></i> Staff List
                                    </h3>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-secondary active" id="cardViewBtn">
                                            <i class="fas fa-id-card"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" id="tableViewBtn">
                                            <i class="fas fa-list"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#addUserModal">
                                    <i class="fas fa-plus mr-1"></i> Add Staff
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!-- Search Bar -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="searchUser" class="form-control border-left-0" placeholder="Search staff...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select id="filterRole" class="form-control form-control-sm custom-select w-auto float-right" style="width: 150px;">
                                        <option value="">All Roles</option>
                                        <option value="admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Part-Time">Part-Time</option>
                                    </select>
                                    <select id="filterStatus" class="form-control form-control-sm custom-select w-auto float-right mr-2" style="width: 150px;">
                                        <option value="">All Status</option>
                                        <option value="Active">Active</option>
                                        <option value="In Active">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Card View -->
                            <div id="cardViewContainer">
                                <div class="row" id="userCards">
                                    <div class="col-12 text-center py-5 text-muted">
                                        <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                                        <p>Loading staff accounts...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Table View (Hidden by default) -->
                            <div id="tableViewContainer" style="display: none;">
                                <div class="table-responsive">
                                    <table id="userTable" class="table table-hover table-sm">
                                        <thead class="bg-light">
                                            <tr class="small text-secondary text-uppercase">
                                                <th width="5%">#</th>
                                                <th style="display: none;">ID</th>
                                                <th width="20%">Name</th>
                                                <th width="15%">Username</th>
                                                <th width="10%">Role</th>
                                                <th width="10%">Status</th>
                                                <th width="15%">Phone</th>
                                                <th width="15%">Created</th>
                                                <th width="10%" class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form id="addUserForm">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-normal text-secondary">
                        <i class="fas fa-user-plus mr-2"></i> Add Staff Account
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g., Juan Dela Cruz" required>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Role</label>
                                <select name="role" class="form-control custom-select">
                                    <option value="admin">👑 Admin</option>
                                    <option value="Staff">👤 Staff</option>
                                    <option value="Part-Time">🕒 Part-Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Status</label>
                                <select name="status" class="form-control custom-select">
                                    <option value="Active">🟢 Active</option>
                                    <option value="In Active">🔴 Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="09XXXXXXXXX">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form id="editUserForm">
                <?= csrf_field() ?>
                <input type="hidden" id="editId" name="id">
                
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-normal text-secondary">
                        <i class="fas fa-user-edit mr-2"></i> Edit Staff Account
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Full Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Username</label>
                        <input type="text" name="username" id="editUsername" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Password <span class="text-muted font-weight-normal">(leave blank to keep current)</span></label>
                        <input type="password" name="password" id="editPassword" class="form-control" placeholder="••••••••">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Role</label>
                                <select name="role" id="editRole" class="form-control custom-select">
                                    <option value="admin">👑 Admin</option>
                                    <option value="Staff">👤 Staff</option>
                                    <option value="Part-Time">🕒 Part-Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small text-secondary font-weight-medium">Status</label>
                                <select name="status" id="editStatus" class="form-control custom-select">
                                    <option value="Active">🟢 Active</option>
                                    <option value="In Active">🔴 Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small text-secondary font-weight-medium">Phone Number</label>
                        <input type="text" name="phone" id="editPhone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-secondary btn-sm px-4">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toasts-top-right fixed" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999;"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script> const baseUrl = "<?= base_url() ?>"; </script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

<!-- DataTables JS -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>

<!-- Custom Users JS -->
<script src="<?= base_url('js/users/users.js') ?>"></script>

<style>
.card {
    border-radius: 10px;
}

/* Card View Styles */
.user-card {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1rem;
    background: white;
    transition: all 0.2s ease;
    height: 100%;
}
.user-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border-color: #d1d5db;
}
.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 500;
    color: white;
    margin-right: 12px;
}
.avatar-admin { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.avatar-staff { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
.avatar-parttime { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.user-info {
    flex: 1;
}
.user-name {
    font-weight: 600;
    color: #374151;
    margin-bottom: 2px;
}
.user-username {
    font-size: 0.8rem;
    color: #6b7280;
}
.user-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
}
.badge-admin { background: #ede9fe; color: #6d28d9; }
.badge-staff { background: #dbeafe; color: #1d4ed8; }
.badge-parttime { background: #fce7f3; color: #be185d; }
.status-active { background: #d1fae5; color: #065f46; }
.status-inactive { background: #fee2e2; color: #991b1b; }
.user-detail {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 8px;
}
.user-detail i {
    width: 16px;
    margin-right: 6px;
}

/* Table Styles */
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
.table thead th {
    border-bottom: 1px solid #e5e7eb;
    font-weight: 500;
}

/* Button Styles */
.btn-outline-secondary {
    border-color: #d1d5db;
    color: #4b5563;
}
.btn-outline-secondary:hover,
.btn-outline-secondary.active {
    background: #f3f4f6;
    border-color: #9ca3af;
    color: #374151;
}
.btn-secondary {
    background: #6b7280;
    border-color: #6b7280;
}
.btn-secondary:hover {
    background: #4b5563;
    border-color: #4b5563;
}

/* Modal Styles */
.modal-content {
    border-radius: 12px;
}
.custom-select, .form-control {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.9rem;
}
.custom-select:focus, .form-control:focus {
    border-color: #9ca3af;
    box-shadow: 0 0 0 0.2rem rgba(107, 114, 128, 0.15);
}

/* DataTables */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1rem;
}
.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 4px 8px;
}
.page-item.active .page-link {
    background-color: #6b7280;
    border-color: #6b7280;
}
.page-link {
    color: #4b5563;
}
.page-link:hover {
    color: #374151;
}
</style>
<?= $this->endSection() ?>