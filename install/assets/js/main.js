$(function ($) {
    "use strict";

    jQuery(document).ready(function () {
       
    $(".footer-area a").on("click", function(event){
        if ($(this).is("[disabled]")) {
            event.preventDefault();
            $(this).parent().find('.check-error').html('Please meet all requirements first!');
        }
    });
       
    // $("#submit-btn").on("click", function(event){
    //     $(this).parent().parent().submit();
    // });

    
    });


    $('#submit-btn').on("click",function () {
        $('.gocover').show();
        $.ajax({
            type: "POST",
            url: "run_install.php",
            data: $("#installer").serialize(),
            async: true,
            success: function(data) {
                //alert("Form Submitted: " + msg);
                setTimeout(function(){
                    if($.trim(data) === 'success'){
                        $('.gocover').hide();
                        window.location.href = domain_URL+'/install?step=completed';
                        //$('#info_head').html('<span style="color:green;"><i class="fa fa-check-circle fa-3x"></i></span><br>Installation Success !!');
                        //$('#info_body').html('Your Installation is completed success fully.<br>Please visit your website now. <br>Thank you');
                        //$('#info_button').html('<a href="'+domain_URL+'/finalize" class="btn btn-default">Close & Run Website</a>');
                        
                    }else {
                        $('.gocover').hide();
                        $('.errors').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>'+data+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
    
                }, 1000);
            }
        })
    });
});