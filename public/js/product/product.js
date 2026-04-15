// Toast Notification Function
function showToast(type, message) {
    if (type === 'success') {
        toastr.success(message, 'Success', {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000
        });
    } else {
        toastr.error(message, 'Error', {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000
        });
    }
}

// Alert Container (fallback if toastr not available)
function showAlert(type, message) {
    var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    var icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
    
    var alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-${icon} mr-2"></i>
            ${message}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    `;
    
    $('#alertContainer').html(alertHtml);
    
    setTimeout(function() {
        $('.alert').fadeOut('slow', function() {
            $(this).remove();
        });
    }, 3000);
}

$(document).ready(function () {
    
    // CSRF Setup
    var csrfName = '<?= csrf_token() ?>' ? 'csrf_test_name' : 'csrf_test_name';
    var csrfToken = $('input[name="' + csrfName + '"]').val();
    
    if (!csrfToken) {
        csrfToken = $('meta[name="csrf-token"]').attr('content');
    }

    // =============================================
    // DATATABLE INITIALIZATION
    // =============================================
    var productTable = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl + 'product/fetchRecords',
            type: 'POST',
            data: function(d) {
                d[csrfName] = csrfToken;
            },
            dataSrc: function(response) {
                return response.data || [];
            },
            error: function(xhr) {
                console.error('DataTable error:', xhr);
                showAlert('error', 'Failed to load products');
            }
        },
        columns: [
            { 
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                },
                className: 'text-muted small'
            },
            { 
                data: 'id', 
                visible: false 
            },
            {
                data: 'category_id',
                render: function(data) {
                    var categories = {
                        1: { name: 'Beverages', icon: '🥤' },
                        2: { name: 'Snacks', icon: '🍪' },
                        3: { name: 'Canned Goods', icon: '🥫' },
                        4: { name: 'Personal Care', icon: '🧴' },
                        5: { name: 'Household Items', icon: '🏠' }
                    };
                    var cat = categories[data] || { name: 'Unknown', icon: '📦' };
                    return cat.icon + ' ' + cat.name;
                },
                className: 'small'
            },
            { 
                data: 'name',
                render: function(data) {
                    return '<span class="font-weight-medium">' + escapeHtml(data) + '</span>';
                },
                className: 'small'
            },
            { 
                data: 'price',
                render: function(data) {
                    return '<span class="text-success">₱' + parseFloat(data).toFixed(2) + '</span>';
                },
                className: 'text-right small'
            },
            { 
                data: 'stock',
                render: function(data) {
                    var stock = parseInt(data) || 0;
                    var badgeClass = 'badge-success';
                    if (stock === 0) badgeClass = 'badge-danger';
                    else if (stock <= 5) badgeClass = 'badge-warning';
                    else if (stock <= 10) badgeClass = 'badge-info';
                    
                    return '<span class="badge ' + badgeClass + '">' + stock + '</span>';
                },
                className: 'text-center small'
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-secondary edit-btn" data-id="${row.id}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger delete-btn" data-id="${row.id}" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    `;
                },
                className: 'text-center'
            }
        ],
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            search: '<i class="fas fa-search"></i>',
            searchPlaceholder: 'Search products...',
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_ products',
            infoEmpty: 'No products found',
            emptyTable: '<div class="text-center py-4 text-muted"><i class="fas fa-box-open fa-2x mb-2"></i><br>No products available</div>'
        },
        drawCallback: function() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    // Escape HTML helper
    function escapeHtml(text) {
        if (!text) return '';
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    // =============================================
    // ADD PRODUCT
    // =============================================
    $('#addProductForm').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var originalText = $submitBtn.html();
        
        $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');
        
        $.ajax({
            url: baseUrl + 'product/save',
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success' || response.success) {
                    $('#addProductModal').modal('hide');
                    $form[0].reset();
                    
                    if (typeof toastr !== 'undefined') {
                        showToast('success', 'Product added successfully');
                    } else {
                        showAlert('success', 'Product added successfully');
                    }
                    
                    productTable.ajax.reload(null, false);
                } else {
                    var msg = response.message || 'Failed to add product';
                    if (typeof toastr !== 'undefined') {
                        showToast('error', msg);
                    } else {
                        showAlert('error', msg);
                    }
                }
            },
            error: function(xhr) {
                var msg = 'An error occurred';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                if (typeof toastr !== 'undefined') {
                    showToast('error', msg);
                } else {
                    showAlert('error', msg);
                }
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    // =============================================
    // EDIT PRODUCT - Load Data
    // =============================================
    $(document).on('click', '.edit-btn', function() {
        var productId = $(this).data('id');
        
        $.ajax({
            url: baseUrl + 'product/edit/' + productId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.data) {
                    $('#editCategoryId').val(response.data.category_id);
                    $('#editName').val(response.data.name);
                    $('#editPrice').val(response.data.price);
                    $('#editStock').val(response.data.stock);
                    $('#editId').val(response.data.id);
                    $('#editProductModal').modal('show');
                } else {
                    if (typeof toastr !== 'undefined') {
                        showToast('error', 'Failed to load product data');
                    } else {
                        showAlert('error', 'Failed to load product data');
                    }
                }
            },
            error: function() {
                if (typeof toastr !== 'undefined') {
                    showToast('error', 'Error loading product data');
                } else {
                    showAlert('error', 'Error loading product data');
                }
            }
        });
    });

    // =============================================
    // UPDATE PRODUCT
    // =============================================
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var originalText = $submitBtn.html();
        
        $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...');
        
        $.ajax({
            url: baseUrl + 'product/update',
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editProductModal').modal('hide');
                    
                    if (typeof toastr !== 'undefined') {
                        showToast('success', 'Product updated successfully');
                    } else {
                        showAlert('success', 'Product updated successfully');
                    }
                    
                    productTable.ajax.reload(null, false);
                } else {
                    var msg = response.message || 'Failed to update product';
                    if (typeof toastr !== 'undefined') {
                        showToast('error', msg);
                    } else {
                        showAlert('error', msg);
                    }
                }
            },
            error: function(xhr) {
                if (typeof toastr !== 'undefined') {
                    showToast('error', 'Error updating product');
                } else {
                    showAlert('error', 'Error updating product');
                }
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    // =============================================
    // DELETE PRODUCT
    // =============================================
    $(document).on('click', '.delete-btn', function() {
        var productId = $(this).data('id');
        
        if (!confirm('Are you sure you want to delete this product?')) {
            return;
        }
        
        var data = {
            _method: 'DELETE'
        };
        data[csrfName] = csrfToken;
        
        $.ajax({
            url: baseUrl + 'product/delete/' + productId,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (typeof toastr !== 'undefined') {
                        showToast('success', 'Product deleted successfully');
                    } else {
                        showAlert('success', 'Product deleted successfully');
                    }
                    
                    productTable.ajax.reload(null, false);
                } else {
                    var msg = response.message || 'Failed to delete product';
                    if (typeof toastr !== 'undefined') {
                        showToast('error', msg);
                    } else {
                        showAlert('error', msg);
                    }
                }
            },
            error: function() {
                if (typeof toastr !== 'undefined') {
                    showToast('error', 'Error deleting product');
                } else {
                    showAlert('error', 'Error deleting product');
                }
            }
        });
    });

    // =============================================
    // MODAL RESET ON CLOSE
    // =============================================
    $('#addProductModal').on('hidden.bs.modal', function() {
        $('#addProductForm')[0].reset();
        $('#addProductForm button[type="submit"]').prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save');
    });
    
    $('#editProductModal').on('hidden.bs.modal', function() {
        $('#editProductForm')[0].reset();
        $('#editProductForm button[type="submit"]').prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Update');
    });

});