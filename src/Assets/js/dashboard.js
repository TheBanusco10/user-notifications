(function ($) {
    
    let usersContainer = $('.un__dashboard .un__users .un__user');

    let selectAllUsersButton = $('.un__dashboard .un__users-selected-container button[data-button="un__select-all-users"]');
    let isSelectAllUsers = false;

    let sendNotificationButton = $('button[data-button="un__sendNotification"]');

    let inputs = $('input, textarea, .un__user, button[data-button="un__select-all-users"]');

    let form = $('#un__form');

    usersContainer.on('click', function () {
       $(this).toggleClass('active');
       userNotifications_printNumUsersSelected($);
    });

    selectAllUsersButton.on('click', function () {
        isSelectAllUsers = !isSelectAllUsers;

        if (isSelectAllUsers) {
            usersContainer.addClass('active');
            selectAllUsersButton.text('Deselect all');
        } else {
            usersContainer.removeClass('active');
            selectAllUsersButton.text('Select all');
        }

        userNotifications_printNumUsersSelected($);
    });

    inputs.on('click focusout keydown keyup', function () {
        if (userNotifications_isValidToSend($) && form.valid()) sendNotificationButton.removeClass('button-disabled');
        else sendNotificationButton.addClass('button-disabled');
    });

    form.validate({
        rules: {
            title: {
                required: true,
                minlength: 4,
                maxlength: 50
            },
            content: {
                required: true,
                minlength: 4,
                maxlength: 700
            }
        }
    });

    form.on('click', function (evt) {
       evt.preventDefault();
    });

})(jQuery);