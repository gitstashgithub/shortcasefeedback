$(document).ready(function () {
    $('.item-required').click(function () {
        $('#item' + $(this).data('id')).toggle();
    });

    $('#send-email').click(function () {
        $("#notification").html('<span class="label label-info">Sending...</span>');

        $.ajax({
            type: "POST",
            url: "/assessments/mail",
            data: $('form').serialize(),
            success: function (result) {
                if(result.success){
                    $("#notification").html('<span class="label label-success">Success</span>');
                }else{
                    $("#notification").html('<span class="label label-danger">Failed to send email</span>');
                }
            },
            error:function(){
                $("#notification").html('<span class="label label-danger">Failed to send email</span>');
            }
        });
    });
});
function toggleTechniques(id, value) {
    if (value == 3) {
        $('#technique-' + id).show();
    } else {
        $('#technique-' + id).hide();
    }

}