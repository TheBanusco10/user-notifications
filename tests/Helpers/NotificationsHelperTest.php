<?php

namespace UserNotifications\tests\Helpers;

use PHPUnit\Framework\TestCase;
use UserNotifications\Helpers\NotificationsHelper;
use WP_Mock;

final class NotificationsHelperTest extends TestCase
{
    public function testCanUserSeeNotification()
    {
        WP_Mock::userFunction('get_userdata')->andReturn([
            'roles' => ['administrator']
        ]);
        WP_Mock::userFunction('carbon_get_post_meta')->andReturn(['administrator']);

        $result = NotificationsHelper::canUserSeeNotification();

        $this->assertTrue($result);
    }
}
