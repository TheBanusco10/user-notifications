(function ($) {
    
    let usersContainer = $('.un__dashboard .un__users .un__user');
    
    // Buttons
    let selectAllUsers = $('.un__dashboard .un__users-selected-container button[data-button="un__select-all-users"]');
    let isSelectAllUsers = false;

    usersContainer.on('click', function () {
       $(this).toggleClass('active');
       getAndPrintNumUsersSelected();
    });

    selectAllUsers.on('click', function () {
        isSelectAllUsers = !isSelectAllUsers;

        if (isSelectAllUsers) {
            usersContainer.addClass('active');
            selectAllUsers.text('Deselect all');
        } else {
            usersContainer.removeClass('active');
            selectAllUsers.text('Select all');
        }

        getAndPrintNumUsersSelected();
    });

    function getAndPrintNumUsersSelected() {
        let numUserSelected = $('.un__dashboard .un__users .un__user.active').length;
        $('.un__dashboard .un__users-selected').text(numUserSelected);
    }

})(jQuery);