<?php

$users = get_users( [
	'exclude' => [ get_current_user_id() ]
] );

$notification = get_option('notification');

var_dump($notification);

//var_dump($users);

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

