(function ($) {
    
    let usersContainer = $('.un__dashboard .un__users .un__user');

    let selectAllUsersButton = $('.un__dashboard .un__users-selected-container button[data-button="un__select-all-users"]');
    let isSelectAllUsers = false;

    let sendNotificationButton = $('button[data-button="un__sendNotification"]');

    let notificationTitle = $('#un__notification-title');
    let notificationContent = $('#un__notification-description');

    let inputs = $('input, textarea, .un__user');

    usersContainer.on('click', function () {
       $(this).toggleClass('active');
       printNumUsersSelected();
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

        printNumUsersSelected();
    });

    inputs.on('click focusout keydown keyup', function () {
        if (isValidToSend()) sendNotificationButton.removeClass('button-disabled');
        else sendNotificationButton.addClass('button-disabled');
    });

    /**
     * Update number of selected users
     */
    function printNumUsersSelected() {
        $('.un__dashboard .un__users-selected').text(getNumUsersSelected().length);
    }

    function getNumUsersSelected() {
        return $('.un__dashboard .un__users .un__user.active');
    }

    /**
     * Check if all inputs are filled (Input, Textarea and NumUserSelected)
     */
    function isValidToSend() {
        return notificationTitle.val().length > 0 && notificationContent.val().length > 0 && getNumUsersSelected().length > 0;
    }

})(jQuery);