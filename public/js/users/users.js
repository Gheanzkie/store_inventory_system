// =============================================
// GLOBAL VARIABLES
// =============================================
var allUsers = [];
var userTable = null;

var csrfName = 'csrf_test_name';
var csrfToken = $('input[name="' + csrfName + '"]').val();
if (!csrfToken) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
}

// =============================================
// TOAST NOTIFICATION
// =============================================
function showToast(type, message) {
    if (typeof toastr !== 'undefined') {
        toastr[type](message, type === 'success' ? 'Success' : 'Error', {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000
        });
    } else {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
        $('#alertContainer').html(`
            <div class="alert ${alertClass} alert-dismissible fade show shadow-sm border-0">
                <i class="fas fa-${icon} mr-2"></i> ${message}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        `);
        setTimeout(() => $('.alert').fadeOut('slow', function() { $(this).remove(); }), 3000);
    }
}

// =============================================
// LOAD ALL USERS
// =============================================
function loadAllUsers() {
    $.ajax({
        url: baseUrl + 'users/fetchRecords',
        method: 'POST',
        data: { [csrfName]: csrfToken },
        dataType: 'json',
        success: function(response) {
            if (response.data) {
                allUsers = response.data;
                loadUserCards(allUsers);
            } else {
                $('#userCards').html(`
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="fas fa-users-slash fa-3x mb-3"></i>
                        <p>No staff accounts found</p>
                    </div>
                `);
            }
        },
        error: function() {
            $('#userCards').html(`
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <p>Failed to load staff accounts</p>
                    <button class="btn btn-outline-secondary btn-sm mt-2" onclick="loadAllUsers()">
                        <i class="fas fa-sync-alt mr-1"></i> Retry
                    </button>
                </div>
            `);
        }
    });
}

// =============================================
// LOAD USER CARDS
// =============================================
function loadUserCards(users) {
    var container = $('#userCards');
    container.empty();
    
    if (!users || users.length === 0) {
        container.html(`
            <div class="col-12 text-center py-5 text-muted">
                <i class="fas fa-users-slash fa-3x mb-3"></i>
                <p>No staff accounts found</p>
            </div>
        `);
        return;
    }
    
    users.forEach(function(user) {
        var avatarClass = 'avatar-staff';
        var roleBadge = 'badge-staff';
        var roleIcon = '👤';
        
        if (user.role === 'admin') {
            avatarClass = 'avatar-admin';
            roleBadge = 'badge-admin';
            roleIcon = '👑';
        } else if (user.role === 'Part-Time') {
            avatarClass = 'avatar-parttime';
            roleBadge = 'badge-parttime';
            roleIcon = '🕒';
        }
        
        var initials = user.name ? user.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2) : 'US';
        var statusClass = user.status === 'Active' ? 'status-active' : 'status-inactive';
        var statusIcon = user.status === 'Active' ? '🟢' : '🔴';
        
        var card = `
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="user-card">
                    <div class="d-flex align-items-start">
                        <div class="user-avatar ${avatarClass}">${initials}</div>
                        <div class="user-info">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="user-name">${escapeHtml(user.name || 'N/A')}</div>
                                    <div class="user-username">@${escapeHtml(user.username || '')}</div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary btn-sm edit-btn" data-id="${user.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm delete-btn" data-id="${user.id}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="user-badge ${roleBadge}">${roleIcon} ${user.role || 'Staff'}</span>
                        <span class="user-badge ${statusClass} ml-1">${statusIcon} ${user.status || 'Active'}</span>
                    </div>
                    <div class="user-detail mt-2">
                        <div><i class="fas fa-phone-alt"></i> ${escapeHtml(user.phone || '—')}</div>
                        <div><i class="far fa-calendar-alt"></i> ${user.created_at ? new Date(user.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '—'}</div>
                    </div>
                </div>
            </div>
        `;
        
        container.append(card);
    });
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}

// =============================================
// FILTER USERS
// =============================================
function filterUsers() {
    var searchTerm = $('#searchUser').val().toLowerCase();
    var role = $('#filterRole').val();
    var status = $('#filterStatus').val();
    
    var filtered = allUsers.filter(function(user) {
        var matchSearch = (user.name || '').toLowerCase().includes(searchTerm) || 
                         (user.username || '').toLowerCase().includes(searchTerm);
        var matchRole = !role || user.role === role;
        var matchStatus = !status || user.status === status;
        return matchSearch && matchRole && matchStatus;
    });
    
    loadUserCards(filtered);
}

// =============================================
// DOCUMENT READY
// =============================================
$(document).ready(function() {
    
    loadAllUsers();
    
    // View Toggle
    $('#cardViewBtn').click(function() {
        $(this).addClass('active');
        $('#tableViewBtn').removeClass('active');
        $('#cardViewContainer').show();
        $('#tableViewContainer').hide();
        filterUsers();
    });
    
    $('#tableViewBtn').click(function() {
        $(this).addClass('active');
        $('#cardViewBtn').removeClass('active');
        $('#cardViewContainer').hide();
        $('#tableViewContainer').show();
        if (allUsers.length > 0) initDataTable();
    });
    
    // Search and Filter
    $('#searchUser').on('keyup', filterUsers);
    $('#filterRole, #filterStatus').on('change', filterUsers);
    
    // Add User
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $btn = $form.find('button[type="submit"]');
        var originalText = $btn.html();
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');
        
        $.ajax({
            url: baseUrl + 'users/save',
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#addUserModal').modal('hide');
                    $form[0].reset();
                    showToast('success', 'Staff account added');
                    loadAllUsers();
                } else {
                    showToast('error', response.message || 'Failed to add staff');
                }
            },
            error: function() {
                showToast('error', 'An error occurred');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
    
    // Edit User - Load Data
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'users/edit/' + id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.data) {
                    $('#editId').val(response.data.id);
                    $('#editName').val(response.data.name);
                    $('#editUsername').val(response.data.username);
                    $('#editRole').val(response.data.role);
                    $('#editStatus').val(response.data.status);
                    $('#editPhone').val(response.data.phone);
                    $('#editUserModal').modal('show');
                }
            }
        });
    });
    
    // Update User
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $btn = $form.find('button[type="submit"]');
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...');
        
        $.ajax({
            url: baseUrl + 'users/update',
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editUserModal').modal('hide');
                    showToast('success', 'Staff account updated');
                    loadAllUsers();
                } else {
                    showToast('error', response.message || 'Failed to update');
                }
            },
            error: function() {
                showToast('error', 'An error occurred');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Update');
            }
        });
    });
    
    // Delete User
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        if (!confirm('Delete this staff account?')) return;
        
        var data = { _method: 'DELETE' };
        data[csrfName] = csrfToken;
        
        $.ajax({
            url: baseUrl + 'users/delete/' + id,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showToast('success', 'Staff account deleted');
                    loadAllUsers();
                } else {
                    showToast('error', response.message || 'Failed to delete');
                }
            }
        });
    });
    
    // Table View Init
    function initDataTable() {
        if ($.fn.DataTable.isDataTable('#userTable')) {
            $('#userTable').DataTable().destroy();
        }
        userTable = $('#userTable').DataTable({
            data: allUsers,
            columns: [
                { data: null, render: (d, t, r, meta) => meta.row + 1 },
                { data: 'id', visible: false },
                { data: 'name' },
                { data: 'username' },
                { data: 'role' },
                { data: 'status' },
                { data: 'phone' },
                { data: 'created_at', render: d => d ? new Date(d).toLocaleDateString() : '' },
                { 
                    data: null,
                    orderable: false,
                    render: row => `
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-secondary edit-btn" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-outline-danger delete-btn" data-id="${row.id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    `
                }
            ]
        });
    }
});