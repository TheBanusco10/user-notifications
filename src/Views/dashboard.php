<?php

use UserNotifications\Classes\NotificationCPT;

$users = get_users( [
	'exclude' => [ get_current_user_id() ]
] );

//$notification = get_option('notification');
$notifications = new WP_Query( [
	'post_type'  => NotificationCPT::POST_TYPE,
	'meta_query' => [
        [
	        'key'     => 'users',
	        'value'   => '3',
	        'compare' => 'LIKE'
        ]
	]
] );

var_dump($notifications->get_posts());
var_dump(get_post_meta($notifications->get_posts()[0]->ID, 'users', true));

?>

<h1>User Notifications - Dashboard</h1>

<div class="un__dashboard">
    <p class="un__users-selected-container">
        Selected: <span class="un__users-selected">0</span> / <?= sizeof($users) ?>
        <button data-button="un__select-all-users">Select all</button>
    </p>

    <section class="un__users">
        <?php foreach ($users as $user): ?>
            <div class="un__user" data-id="<?= $user->ID ?>">
                <p class="un__name">
                    <?= $user->display_name ?>
                </p>
                <p class="un__email">
                    <?= $user->user_email ?>
                </p>
            </div>
        <?php endforeach; ?>
    </section>

    <button data-button="un__sendNotification">Send notification</button>
</div>


