
$(document).ready(function(){



    var typingTimer;  // Timer identifier
    var typingDelay = 500;  // Delay in milliseconds (e.g., 500ms delay)

    $('#s_name').on('keyup', function () {
        clearTimeout(typingTimer);  // Clear the previous timer
        typingTimer = setTimeout(function () {
            $('#roleTable').DataTable().ajax.reload();
        }, typingDelay);
    });



    $('#roleTable').on('click', '.btn-delete', function() {
        var id = $(this).attr('data');
        $('.confirm-delete').val(id);
    });


    $('.confirm-delete').click(function() {
        var id = $(this).val();

        $.ajax({
            url: route('admin.review.delete'),
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
                toastr.error(error);
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
            url: route('admin.publish.review'),
            type: 'get',
            async: false,
            dataType: 'json',
            data: { id: id,isPublish:isPublish},
            success: function(response) {
                console.log(response);
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


    $('.btn-modal-close').click(function() {
        // addElement();
    });
    function addElement(){
        $('.btn-save-changes').css('display', 'none');
        $('.btn-add').css('display', 'block');
        $('.add-lang-title').css('display', 'block');
        $('.edit-lang-title').css('display', 'none');
        $('#RolesForm')[0].reset();
    }
    function editElement(){
        $('.add-lang-title').css('display', 'none');
        $('.edit-lang-title').css('display', 'block');
        $('.btn-save-changes').css('display', 'block');
        $('.btn-add').css('display', 'none');
    }
    $('#PermForm').on('submit', function(e) {
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
                $('.btn-submit').text('Saving...');
                $(".btn-submit").prop("disabled", true);
            },
            success: function(response) {

                if (response.status==true) {
                    $('#roleTable').DataTable().ajax.reload();
                    toastr.success(response.message);
                    $('#PermForm')[0].reset();
                    $('.btn-close').click();
                    $('.btn-submit').text('Save');
                    $(".btn-submit").prop("disabled", false);

                }
                if (response.status==false) {
                    toastr.error(response.message);
                    $('.btn-submit').text('Save');
                    $(".btn-submit").prop("disabled", false);
                }
            },

            complete: function(data) {
                $(".btn-submit").html("Save");
                $(".btn-submit").prop("disabled", false);
            },

            error: function() {;
                $('.btn-submit').text('Save');
                $(".btn-submit").prop("disabled", false);
            }
        });
    });

    $('#showModal').modal({
        backdrop: 'static',
        keyboard: false
    })
});


