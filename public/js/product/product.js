// =============================================
// TOAST NOTIFICATION
// =============================================
function showToast(type, message) {
    if (typeof toastr !== 'undefined') {
        toastr[type](message, type === 'success' ? 'Success' : 'Error', {
            closeButton: true, progressBar: true, positionClass: 'toast-top-right', timeOut: 3000
        });
    } else {
        showAlert(type, message);
    }
}

function showAlert(type, message) {
    var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    var icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
    $('#alertContainer').html(`
        <div class="alert ${alertClass} alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-${icon} mr-2"></i>${message}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    `);
    setTimeout(() => $('.alert').fadeOut('slow', function() { $(this).remove(); }), 3000);
}

function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(text));
    return div.innerHTML;
}

$(document).ready(function () {
    
    var csrfName = '<?= csrf_token() ?>' ? 'csrf_test_name' : 'csrf_test_name';
    var csrfToken = $('input[name="' + csrfName + '"]').val() || $('meta[name="csrf-token"]').attr('content');

    // =============================================
    // DATATABLE - NO BUILT-IN SEARCH
    // =============================================
    var productTable = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false, // ✅ Disable built-in search
        ajax: {
            url: baseUrl + 'product/fetchRecords',
            type: 'POST',
            data: function(d) { d[csrfName] = csrfToken; },
            dataSrc: 'data',
            error: function(xhr) {
                console.error('DataTable error:', xhr);
                showAlert('error', 'Failed to load products');
            }
        },
        columns: [
            { data: null, render: (d, t, r, meta) => meta.row + 1, className: 'text-muted small' },
            { data: 'id', visible: false },
            {
                data: 'category_id',
                render: function(data) {
                    var categories = {
                        1: '🥤 Beverages', 2: '🍪 Snacks', 3: '🥫 Canned Goods',
                        4: '🧴 Personal Care', 5: '🏠 Household Items'
                    };
                    return categories[data] || '📦 Unknown';
                },
                className: 'small'
            },
            { data: 'name', render: d => '<span class="font-weight-medium">' + escapeHtml(d) + '</span>', className: 'small' },
            { data: 'price', render: d => '<span class="text-success">₱' + parseFloat(d).toFixed(2) + '</span>', className: 'text-right small' },
            {
                data: 'stock',
                render: function(data) {
                    var stock = parseInt(data) || 0;
                    var badge = stock === 0 ? 'danger' : (stock <= 5 ? 'warning' : (stock <= 10 ? 'info' : 'success'));
                    return '<span class="badge badge-' + badge + '">' + stock + '</span>';
                },
                className: 'text-center small'
            },
            {
                data: null, orderable: false, searchable: false,
                render: row => `
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-secondary edit-btn" data-id="${row.id}" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-outline-danger delete-btn" data-id="${row.id}" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </div>
                `,
                className: 'text-center'
            }
        ],
        responsive: true, autoWidth: false, pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_',
            infoEmpty: 'No products',
            emptyTable: '<div class="text-center py-4 text-muted"><i class="fas fa-box-open fa-2x mb-2"></i><br>No products</div>'
        },
        drawCallback: function() {
            $('#countDisplay').text(productTable.rows({ filter: 'applied' }).count());
        }
    });

    $('#countDisplay').text(productTable.rows().count());

    // =============================================
    // CUSTOM SEARCH (ISA LANG)
    // =============================================
    $('#searchProduct').on('keyup', function() {
        productTable.search(this.value).draw();
    });

    // =============================================
    // ADD PRODUCT
    // =============================================
    $('#addProductForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this), $btn = $form.find('button[type="submit"]'), original = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Saving...');
        
        $.ajax({
            url: baseUrl + 'product/save', method: 'POST', data: $form.serialize(), dataType: 'json',
            success: function(r) {
                if (r.status === 'success' || r.success) {
                    $('#addProductModal').modal('hide'); $form[0].reset();
                    showToast('success', 'Product added');
                    productTable.ajax.reload(null, false);
                } else {
                    showToast('error', r.message || 'Failed to add');
                }
            },
            error: function(xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.message) || 'An error occurred';
                showToast('error', msg);
            },
            complete: function() { $btn.prop('disabled', false).html(original); }
        });
    });

    // =============================================
    // EDIT PRODUCT - Load Data
    // =============================================
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'product/edit/' + id, method: 'GET', dataType: 'json',
            success: function(r) {
                if (r.data) {
                    $('#editCategoryId').val(r.data.category_id);
                    $('#editName').val(r.data.name);
                    $('#editPrice').val(r.data.price);
                    $('#editStock').val(r.data.stock);
                    $('#editId').val(r.data.id);
                    $('#editProductModal').modal('show');
                } else { showToast('error', 'Failed to load data'); }
            },
            error: function() { showToast('error', 'Error loading data'); }
        });
    });

    // =============================================
    // UPDATE PRODUCT
    // =============================================
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this), $btn = $form.find('button[type="submit"]'), original = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Updating...');
        
        $.ajax({
            url: baseUrl + 'product/update', method: 'POST', data: $form.serialize(), dataType: 'json',
            success: function(r) {
                if (r.success) {
                    $('#editProductModal').modal('hide');
                    showToast('success', 'Product updated');
                    productTable.ajax.reload(null, false);
                } else {
                    showToast('error', r.message || 'Failed to update');
                }
            },
            error: function() { showToast('error', 'Error updating'); },
            complete: function() { $btn.prop('disabled', false).html(original); }
        });
    });

    // =============================================
    // DELETE PRODUCT
    // =============================================
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        if (!confirm('Delete this product?')) return;
        
        var data = { _method: 'DELETE' };
        data[csrfName] = csrfToken;
        
        $.ajax({
            url: baseUrl + 'product/delete/' + id, method: 'POST', data: data, dataType: 'json',
            success: function(r) {
                if (r.success) { showToast('success', 'Product deleted'); productTable.ajax.reload(null, false); }
                else { showToast('error', r.message || 'Failed to delete'); }
            },
            error: function() { showToast('error', 'Error deleting'); }
        });
    });

    // =============================================
    // MODAL RESET
    // =============================================
    $('#addProductModal').on('hidden.bs.modal', function() {
        $('#addProductForm')[0].reset();
        $('#addProductForm button[type="submit"]').prop('disabled', false).html('<i class="fas fa-save mr-1"></i>Save');
    });
    
    $('#editProductModal').on('hidden.bs.modal', function() {
        $('#editProductForm')[0].reset();
        $('#editProductForm button[type="submit"]').prop('disabled', false).html('<i class="fas fa-save mr-1"></i>Update');
    });

});