
$(document).ready(function(){


    $('#PagesForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.btn-submit').text('Processing...');
                $(".btn-submit").prop("disabled", true);
            },
            success: function(response) {

                if (response.status) {
                    toastr.success(response.message);
                }
                if (!response.status) {
                    toastr.error(response.message);
                }
            },

            complete: function(data) {
                $(".btn-submit").html("Save Page");
                $(".btn-submit").prop("disabled", false);
            },

            error: function() {
                $('.btn-submit').text('Save Page');
                $(".btn-submit").prop("disabled", false);
            }
        });
    });



    $('#roleTable').on('click', '.btn-delete', function() {
        var id = $(this).attr('data');
        $('.confirm-delete').val(id);
    });


    $('.confirm-delete').click(function() {
        var id = $(this).val();
        $.ajax({
            url: "delete-product",
            type: 'get',
            async: false,
            dataType: 'json',
            data: { id: id },
            success: function(response) {
                $('#roleTable').DataTable().ajax.reload();
                $('.btn-close').click();
                toastr.success(response.message);
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                toastr.success(error);
            }
        });
    });




});


