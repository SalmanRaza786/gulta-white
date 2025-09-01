
$(document).ready(function(){






    $('#roleTable').on('click', '.btn-delete', function() {
        var id = $(this).attr('data');
        $('.confirm-delete').val(id);

    });


    $('.confirm-delete').click(function() {
        var id = $(this).val();

        $.ajax({
            url: route('admin.p.code.delete'),
            type: 'get',
            async: false,
            dataType: 'json',
            data: { id: id },
            success: function(response) {

                if(response.status){
                    $('#roleTable').DataTable().ajax.reload();
                    $('.btn-close').click();
                      toastr.success(response.message);
                }
                if(!response.status){
                     toastr.error(response.message);
                }

            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;

            }
        });
    });


    $('#roleTable').on('click', '.btn-publish', function() {
        var id = $(this).attr('data');
        $('input[name=inp_is_publish]').val($(this).attr('data-publish'));
        $('.btn-confirm-publish').val(id);
    });


    $('.btn-confirm-publish').click(function() {

        var id = $(this).val();
        var isPublish = $('input[name=inp_is_publish]').val();

        $.ajax({
            url: route('admin.publish.p.code'),
            type: 'get',
            async: false,
            dataType: 'json',
            data: { id: id,isPublish:isPublish},
            success: function(response) {

                if(response.status){
                    $('#roleTable').DataTable().ajax.reload();
                    $('.btn-close').click();
                    toastr.success(response.message);
                }
                if(!response.status){
                    toastr.error(response.message);
                }

            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                toastr.error(error);
            }
        });
    });


});


