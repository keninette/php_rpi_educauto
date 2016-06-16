define(['jquery', 'default', 'domReady!'], function ($) {

        // Hide user form so it can be displayed by clicking to h1 tag
        if ($("#hidden-exam-form").hasClass('valid-form')) { $("#hidden-exam-form").hide(); }
        if ($("#hidden-lesson-form").hasClass('valid-form')) { $("#hidden-lesson-form").hide(); }

        /**
         * Display exam form to be able to add one
         */
        $("#toggle-exam-form").click(function () {
            $("#hidden-exam-form").fadeToggle();
        });

        /**
         * Display lesson form to be able to add one
         */
        $("#toggle-lesson-form").click(function () {
            $("#hidden-lesson-form").fadeToggle();
        });

        /**
         *  Add on click action to delete user
         *  Ajax call to deleteAction() from UserManagementController.php
         */
       $('.delete-link').on('click',function() {
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