define(['jquery', 'default', 'domReady!'], function ($) {
    // Hide user form so it can be displayed by clicking to h1 tag
    if ($("#hidden-ExamCategory-form").hasClass('valid-form')) { $("#hidden-ExamCategory-form").hide(); }

    /**
     * Display student form to be able to add one
     */
    $("#toggle-ExamCategory-form").click(function () {
        $("#hidden-ExamCategory-form").fadeToggle();
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
                //console.log(data.success === true);
                if (data.success) {
                    element.parent().fadeOut().remove();
                } else {
                    displayMessage('error','Ce type d\'examen est utilisé dans le parcours d\'un ou plusieurs candidat(s), il ne peut-être supprimé');
                }
                
            }
            , error: function (xhr, status) {
                console.log(xhr.responseText);
                console.log(status);
            }
        });
    });
});