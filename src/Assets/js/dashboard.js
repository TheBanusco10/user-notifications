(function ($) {
    
    let usersContainer = $('.un__dashboard .un__users .un__user');

    let selectAllUsersButton = $('.un__dashboard .un__users-selected-container button[data-button="un__select-all-users"]');
    let isSelectAllUsers = false;

    let sendNotificationButton = $('.unbutton');

    sendNotificationButton.on('click', function () {
        console.log('From dashboard');
    });

    usersContainer.on('click', function () {
       $(this).toggleClass('active');
       getAndPrintNumUsersSelected();
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

        getAndPrintNumUsersSelected();
    });

    function getAndPrintNumUsersSelected() {
        let numUserSelected = $('.un__dashboard .un__users .un__user.active').length;
        $('.un__dashboard .un__users-selected').text(numUserSelected);
    }

})(jQuery);