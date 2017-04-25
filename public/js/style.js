$(document).ready(function() {

    //only a answer is checked
    $('.container').on('click', '.only-correct>input', function() {
       $('.only-correct>input').not(this).prop('checked', false);
    });

    //sure least one checkbox is checked
    $('.container').on('click', '#create-word',function(e) {
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

    //Apend New Answer For Word
    var indexAnswer = 1;
    $('.container').on('click', '#add-answer', function () {
        var formAddAnswer  = '<div class="wrap-answer">'
            + '<div class="col-md-6 col-md-offset-3">'
            + '<input class="form-control" autofocus="autofocus" name="ans[add_new'
            +  indexAnswer +'][answer]" type="text">'
            + '<span class="form-control-feedback delete-answer">'
            + '<i class="fa fa-trash-o" aria-hidden="true"></i>'
            + '</span></div>'
            + '<label class="col-md-2 control-label only-correct">'
            + '<input name="ans[add_new' + indexAnswer + '][is_correct]" type="checkbox" value="1">'
            + '</label><br/><br/>'
            + '</div>';
        $(".group-answer").append(formAddAnswer);
        indexAnswer++;
    });

    //remove answer
    $('.container').on('click', '.delete-answer', function () {
        $(this).closest('.wrap-answer').remove();
    });
});
