(function ($) {

    let sendNotificationButton = $('.un__dashboard button[data-button="un__sendNotification"]');
    let spinner = $('.spinner');

    let notificationTitle = $('#un__notification-title');
    let notificationContent = $('#un__notification-description');
    let users = $('.un__dashboard .un__users .un__user');

    sendNotificationButton.on('click', function () {

        if ( !userNotifications_isValidToSend($) ) return;

        let usersSelected = $('.un__dashboard .un__users .un__user.active');
        let userIdSelected = [];

        let notificationTitle = $('#un__notification-title');
        let notificationContent = $('#un__notification-description');

        sendNotificationButton.addClass('button-disabled');
        spinner.toggleClass('is-active');

        usersSelected.each(function () {
            userIdSelected.push($(this).data('id'));
        });

        $.ajax({
            type: 'POST',
            url: ajax_wordpress.url,
            data: {
                contentType: 'application/json',
                action: ajax_wordpress.action,
                notification: {
                    title: notificationTitle.val(),
                    description: notificationContent.val()
                },
                users: userIdSelected
            }
        }).done( res => {
            userNotifications_setAlert($, res.result);
        }).fail( err => {
            userNotifications_setAlert($, err.responseJSON.result, 'error');
        }).always( () => {
            spinner.toggleClass('is-active');
            sendNotificationButton.addClass('button-disabled');
            emptyFields();
        });

    });

    /**
     * Empty all the fields: Title, Description, Users selected
     */
    function emptyFields() {
        notificationTitle.val('');
        notificationContent.val('');
        users.removeClass('active');
        userNotifications_printNumUsersSelected($);
    }

})(jQuery);