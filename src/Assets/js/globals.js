/**
 * Set alert using a div existing with id=un__alert
 * @param obj jQuery object, usually $
 * @param message Text to show inside the alert
 * @param type Alert type: success, info, error, warning
 */
function userNotifications_setAlert(obj, message = 'Successful', type = 'success') {
    obj('#un__alert').html(`
        <div class="notice notice-${type}">${message}</div>
    `);
}