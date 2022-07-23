(function ($) {

    let sendNotificationButton = $('.un__dashboard button[data-button="un__sendNotification"]');

    sendNotificationButton.on('click', function () {

        let usersSelected = $('.un__dashboard .un__users .un__user.active');
        let userIdSelected = [];

        usersSelected.each(function () {
            userIdSelected.push($(this).data('id'));
        });

       $.ajax({
           type: 'POST',
           url: ajax_wordpress.url,
           data: {
               action: ajax_wordpress.action,
               notification: 'Ajax working correctly',
               users: userIdSelected
           }
       }).done( res => {
           console.log(res.result);
       }).fail( err => {
           console.error(err);
       });
    });

})(jQuery);