define(['jquery', 'default', 'domReady!'], function ($) {

    // Hide user form so it can be displayed by clicking to h1 tag
    if ($("#hidden-FileCategory-form").hasClass('valid-form')) { $("#hidden-FileCategory-form").hide(); }

    /**
     * Display student form to be able to add one
     */
    $("#toggle-FileCategory-form").click(function () {
        $("#hidden-FileCategory-form").fadeToggle();
    });

    /**
     *  Add on click action to delete user
     *  Ajax call to deleteAction() from UserManagementController.php
     *  Action used on table so it works on every child
     *  Even those added later with jQuery
     */
    $('table').on('click', 'td.fa-times-circle', function() {
        var element = $(this);

        // Call controller
        $.ajax({
            url: element.data("url")
            , type: 'POST'
            , dataType: 'json'
            , success: function (data) {
                console.log(data);
                //element.parent().fadeOut().remove();
            }
            , error: function (xhr, status) {
                console.log(xhr.responseText);
                console.log(status);
            }
        });
    });
});
