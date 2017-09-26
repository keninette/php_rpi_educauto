define(['jquery', 'default', 'domReady!'], function ($) {

    // Hide user form so it can be displayed by clicking to h1 tag
    $("#hidden-user-form").hide();

    /**
     * Send form data to DEEUserBundle:UserMagangement:users controller
     * Add new user to table
     * @returns {boolean} : false (so it doesn't trigger the form action or event)
     */
    $("#hidden-user-form form").submit(function () {
        var postUrl = $("#hidden-user-form").data("url");

        // Add user by calling controller and sending form info
        $.ajax({
            url: postUrl,
            type: 'post',
            dataType: 'json',
            data: $('#hidden-user-form form').serialize(),
            success: function (data) {
                // hide form
                $("#hidden-user-form").fadeToggle();

                // Add user to table
                addUserToTable(data.user);

                // Empty form
                emptyFormInputs();
            },
            error: function (xhr, status) {
                   console.log(xhr.responseText);
                   console.log(status);
               }
        });
        return false;
    });

    /**
     * Display user form to be able to add one
     */
    $("#toggle-user-form").click(function () {
        $("#hidden-user-form").fadeToggle();
    });

    /**
     * ON click on role checkboxes
     * check or uncheck other boxes according to role hierarchy
     * ex : if SUPER_ADMIN is checked, ADMIN must be too
     * @returns {undefined}
     */
    /*$('input[type="checkbox"]').click(function(){
        // If SUPER_ADMIN is checked, check ADMIN
        var inputLvl1 = $(this);

        // We need to manually set checked-attribute 
        // Because with symfony, it somehow doesn't
        if ($(inputLvl1).attr('checked') === 'checked') {
            $(inputLvl1).removeAttr('checked');
        } else {
            $(inputLvl1).attr('checked','checked');
        }

        if ($(inputLvl1).attr('value') === 'ROLE_SUPER_ADMIN' && $(inputLvl1).attr('checked') === 'checked') {
            $('input[type="checkbox"]').each(function(){
                $(this).attr('checked','checked');
            });
        }
    });*/

    /**
     *  Add on click action to activate or deactive user
     *  Ajax call to activateAction() from UserManagementController.php
     */
    $('table').on('click', 'td.fa-circle, td.fa-circle-thin', function() {
        var element = $(this);

        if (element.parent().hasClass('inactive')) {
            displayInactiveWarning();
        } else {
            // Call controller
            $.ajax({
                url: element.data("url")
                , type: 'POST'
                , dataType: 'json'
                , success: function (data) {

                    // Set active or inactive icon depending on user enabled status
                    if (data.active) {
                        element.removeClass("fa-circle-thin").addClass("fa-circle");
                    } else {
                        element.removeClass("fa-circle").addClass("fa-circle-thin");
                    }
                }
                , error: function (xhr, status) {
                    console.log(xhr.responseText);
                    console.log(status);
                }
            });
        }
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
            , error: function (xhr, status, error) {
                console.log(xhr.responseText);
                console.log(status);
            }
        });
    });

    /**
     *  Display warning in flashbag container if user is trying to deactivate or delete his own account
     */
    function displayInactiveWarning() {
        if (!$("#jqueryError").length) {
            $(".other-notice").empty();
            $(".error-notice").empty().append("<p id=\"jqueryError\">Vous ne pouvez pas désactiver ou supprimer l'utilisateur avec lequel vous êtes connecté.</p>");
        }
    }

    /**
     * Add a line to table to display user
     * @param {DEEUSerBundle User} user
     * @returns {undefined}
     */
    function addUserToTable(user) {
        // Set new data-url to deactivate/activate & delete user
        var activateLink    = $(".activate-link").first().data('url');
        var newActivateLink = activateLink.substring(0,(activateLink.length -1)) +user.id;                
        var deleteLink    = $(".delete-link").first().data('url');
        var newDeleteLink = deleteLink.substring(0,(deleteLink.length -1)) +user.id;                

        // Add new user to table
        $("table").append("<tr>"
                                +"<td  class=\"id\">" +user.id +"</td>"
                                +"<td  class=\"username\">" +user.username +"</td>"
                                +"<td  class=\"email\">" +user.email +"</td>"
                                +"<td>" +($.inArray("ROLE_SUPER_ADMIN", user.role) ? "Super-administrateur" : ($.inArray("ROLE_ADMIN") ? "Administrateur" : "")) +"</td>"
                                +"<td class=\"fa fa-1-5x pointer " +(user.enabled ? "fa-circle" : "fa-circle-thin")  +"\" title=\"Désactiver le compte\" data-url=\"" +newActivateLink +"\">&nbsp;</td>"
                                +"<td class=\"fa fa-1-5x pointer fa-times-circle\" title=\"Supprimer le compte\"  data-url=\"" +newDeleteLink +"\">&nbsp;</td>"
                            +"</tr>"
                        );
    }

    /**
     *  Empty all form input (textarea, text, checkbox, etc...)
     * @returns {undefined}
     */
    function emptyFormInputs() {
        $(':input')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }
});