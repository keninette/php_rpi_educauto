define(['jquery', 'default', 'domReady!'], function ($) {

    // Hide user form so it can be displayed by clicking to h1 tag
    if ($("#hidden-student-form").hasClass('valid-form')) { $("#hidden-student-form").hide(); }

    /**
     * Display student form to be able to add one
     */
    $("#toggle-student-form").click(function () {
        $("#hidden-student-form").fadeToggle();
    });

    /**
     *  Add on click action to delete user
     *  Ajax call to deleteAction() from UserManagementController.php
     */
    $('table').on('click', 'td.fa-times-circle', function() {
        var element = $(this);

        // Call controller
        $.ajax({
            url: element.data("url")
            , type: 'POST'
            , dataType: 'json'
            , success: function (data) {
                element.parent().fadeOut().remove();
            }
            , error: function (xhr, status) {
                console.log(xhr.responseText);
                console.log(status);
            }
        });
    });
});