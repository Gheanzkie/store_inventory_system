$('#addSaleForm').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        url: baseUrl + '/sales/save',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            if(res.status === 'success'){
                $('#AddSaleModal').modal('hide');
                $('#addSaleForm')[0].reset();

                toastr.success('Sale added successfully');

                setTimeout(() => location.reload(), 1000);
            } else {
                toastr.error(res.message || 'Failed to save');
            }
        },
        error: function(){
            toastr.error('Server error');
        }
    });
});

