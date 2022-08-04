const NOTIFICATION_TITLE = '#un__notification-title';
const NOTIFICATION_CONTENT = '#un__notification-description';

/**
 * Set alert using a div existing with id=un__alert
 * @param obj jQuery variable. Usually $
 * @param message Text to show inside the alert
 * @param type Alert type: success, info, error, warning
 */
function userNotifications_setAlert(obj, message = 'Successful', type = 'success') {
    obj('#un__alert').html(`
    <div class="notice notice-${type}">${message}</div>
`);
}

/**
 * Update number of selected users
 */
function userNotifications_printNumUsersSelected(obj) {
    obj('.un__dashboard .un__users-selected').text(userNotifications_getNumUsersSelected(obj).length);
}

/**
 * Get all users selected
 *
 * @returns {jQuery|HTMLElement|*}
 */
function userNotifications_getNumUsersSelected(obj) {
    return obj('.un__dashboard .un__users .un__user.active');
}

/**
 * Check if all inputs are filled (Input, Textarea and NumUserSelected)
 */
function userNotifications_isValidToSend(obj) {
    return obj(NOTIFICATION_TITLE).val().length > 0 && obj(NOTIFICATION_CONTENT).val().length > 0 && userNotifications_getNumUsersSelected(obj).length > 0;
}