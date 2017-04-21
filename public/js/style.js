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
});
