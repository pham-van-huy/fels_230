$(document).ready(function() {

    //only a answer is checked
    $('.only-correct>input').click(function()
    {
       $('.only-correct>input').not(this).prop('checked', false);
    });

    //sure least one checkbox is checked
    $('#create-word').click(function(e)
    {
        var is_checked = $('.only-correct>input:checked').length;

        if (is_checked == 0) {
            $('.answer-correct', ).addClass('text-danger');
            e.preventDefault();
        }
    });

    //validate passwor update
    $('#update-profile').click(function(e)
    {
        var new_password = $('#password-new').val().length;
        var password_new_confirm = $('#password-new-confirm').val().length;

        if (new_password > 0 && password_new_confirm == 0) {
            $('#password-new-confirm').addClass('field-require');
            e.preventDefault();
        }

        if (new_password == 0 && password_new_confirm > 0) {
            $('#password-new').addClass('field-require');
            e.preventDefault();
        }
    });
});
