$(document).ready(function() {

    //only a answer is checked
    $('.only-correct>input').on('click', function() {
       $('.only-correct>input').not(this).prop('checked', false);
    });

    //sure least one checkbox is checked
    $('#create-word').on('click', function(e) {
        var is_checked = $('.only-correct>input:checked').length;

        if (is_checked == 0) {
            $('.answer-correct', ).addClass('text-danger');
            e.preventDefault();
        }
    });

    //validate passwor update
    $('#update-profile').on('click', function(e)
    {
        var new_password = $('#password-new').val().length;
        var password_new_confirm = $('#password-new-confirm').val().length;

        if (new_password && !password_new_confirm) {
            $('#password-new-confirm').addClass('field-require');
            e.preventDefault();
        }

        if (!new_password && password_new_confirm) {
            $('#password-new').addClass('field-require');
            e.preventDefault();
        }
    });

    $('.delete-admin').on('click', function (e) {
        var data = $(this).data('confirm');
        var result = confirm(data);

        if (!result) {
            e.preventDefault();
        }
    });

    //add or remove relationship
    $('.action-relationship-user').on('click', function () {
        var varthis = $(this);
        var textRepalce = varthis.attr('data-trans').trim();
        var urlAjax = varthis.data('url-user');
        var textCurrent = varthis.text().trim();
        $.ajax({
            url: urlAjax,
            type: "get",
            datatype: "json",
            success : function (data) {
                if (data.status) {
                    if (data.result == 'add') {
                        varthis.removeClass('btn-success')
                            .addClass('btn-warning')
                            .attr('data-trans', textCurrent)
                            .text(textRepalce);
                    } else {
                        varthis.removeClass('btn-warning')
                            .addClass('btn-success')
                            .attr('data-trans', textCurrent)
                            .text(textRepalce);
                    }
                }
            },
        });
    });
});
