$().ready(function(){

    // set the uniform js
    // $("input, textarea, select, button").uniform();

    if($("div.flash-notice").length > 0)
    {
        $("div.flash-notice").delay(3200).fadeOut(500);
        
    }
});