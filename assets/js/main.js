$(function() {
    function action(actionPage, params, feedbackArea='.feedback', processingArea='.processing', processingMessage='Processing'){
        var ico = '<img src="assets/img/loader.gif" title="'+processingMessage+'" height="22px" alt="IMG_PROCESS"/>';
        console.log(params);
        $.ajax({
            method: "POST",
            url: actionPage,
            data: params,
            beforeSend: function(){
                $(processingArea).html(ico + processingMessage);
                $(processingArea).show();
            },
            complete: function(){$(processingArea).hide();},
            success: function(data){$(feedbackArea).html(data);},
            error: function(){$(feedbackArea).html('Oops! Something went wrong');}
        });
    }
})