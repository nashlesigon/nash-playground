$().ready(function(){

    // set the uniform js
    // $("input, textarea, select, button").uniform();

    $(".flash-subcription-form").submit(function(){
        $("input[type=submit]", this).attr("disabled", "disabled");
    });

    if($("div.flash-notice").length > 0)
    {
        $("div.flash-notice").delay(3200).fadeOut(500);
        
    }
});