<?php

namespace UserNotifications\Helpers;

class NotificationsHelper
{

    /**
     * Returns true or false if the given user can see the notification
     *
     * @param  mixed $userID
     * @param  mixed $postID
     * @return bool
     */
    public static function canUserSeeNotification(int $userID = 0, int $postID = 0): bool
    {
        $userRoles = carbon_get_post_meta($postID, 'user_roles_select');
        $currentUserData = get_userdata($userID);

        if (!$currentUserData) return false;

        return count(array_intersect($userRoles, $currentUserData->roles)) > 0;
    }
}
