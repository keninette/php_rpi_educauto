define(['jquery', 'default', 'domReady!'], function ($) {
    // Hide formulas descriptions
    $(".display-none").hide();
   
   // On click, show or hide formula description
    $(".sub-container-prices").click(function() {
       var helpDivPrefix    = 'sub-container-prices-help-';
       var id               = $(this).attr('id');
       var numDiv           = id.substr(id.length -1);
       
       $('#' +helpDivPrefix +numDiv).fadeToggle('slow');
    }) ;
});