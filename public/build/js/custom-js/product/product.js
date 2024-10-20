
$(document).ready(function(){


    $('#RolesForm').on('submit', function(e) {
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
            success: function(data) {

                if (data.status==true) {
                    $('#roleTable').DataTable().ajax.reload();
                    toastr.success(data.message);
                    $('#RolesForm')[0].reset();
                    $('.btn-close').click();
                    $('.btn-submit').text('Save');
                    $(".btn-submit").prop("disabled", false);

                }
                if (data.status==false) {
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

    var typingTimer;
    var typingDelay = 500;
    $('#s_name').on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            $('#roleTable').DataTable().ajax.reload();
        }, typingDelay);
    });

    $('#roleTable').on('click', '.btn-edit', function() {
        editElement();
        var id = $(this).attr('data');


        $.ajax({
            url: 'edit-product',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: { id: id },
            success: function(response) {
                console.log(response);
                if(response.status==true){
                    $('input[name=id]').val(response.data.id);
                    $('input[name=title]').val(response.data.name);
                    $('input[name=prefix]').val(response.data.prefix);
                    $('input[name=digits]').val(response.data.digit_length);

                }else{
                    toastr.error(response.message)
                }


            },
            error: function(xhr, status, error) {
                toastr.error(error);
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

    $('.btn-modal-close').click(function() {
        addElement();
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
    $('#CodeForm').on('submit', function(e) {
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
                    $('#CodeForm')[0].reset();
                    $('.btn-close').click();
                    $('.btn-submit').text('Save');
                    $(".btn-submit").prop("disabled", false);
                    window.location.href=route('admin.codes.print.batch',{'batch':response.data.batch_no});

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

    $('#roleTable').on('click', '.btn-edit-text', function() {
        editElement();
        var id = $(this).attr('data');


        $.ajax({
            url: 'edit-text-message',
            type: 'GET',
            async: false,
            dataType: 'json',
            data: { id: id },
            success: function(response) {

                if(response.status==true){
                    $('input[name=id]').val(response.data.id);
                    $('textarea[name=valid_message]').val(response.data.valid_message);
                    $('textarea[name=invalid_message]').val(response.data.in_valid_message);
                    $('textarea[name=verified_message]').val(response.data.verified_message);

                }else{
                    toastr.error(response.message)
                }

            },
            error: function(xhr, status, error) {
                toastr.error(error);
            }
        });
    });

    $('#TextMessageForm').on('submit', function(e) {
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
            success: function(data) {

                if (data.status==true) {
                    $('#roleTable').DataTable().ajax.reload();
                    toastr.success(data.message);
                    $('#TextMessageForm')[0].reset();
                    $('.btn-close').click();
                    $('.btn-submit').text('Save');
                    $(".btn-submit").prop("disabled", false);

                }
                if (data.status==false) {
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

    $('#s_status').on('change', function () {

        $('#roleTable').DataTable().ajax.reload();
    });
});


