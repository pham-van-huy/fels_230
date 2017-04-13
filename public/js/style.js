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
});
