<?php

$users = get_users( [
	'exclude' => [ get_current_user_id() ]
] );

?>

<h1>User Notifications - Dashboard</h1>

<div class="un__dashboard">

	<?php include PLUGIN_VIEWS_PATH . 'partials/alert.php' ?>

    <section id="un__notification-content">
        <form id="un__form">
            <div>
                <label for="un__notification-title">Title</label>
                <input type="text" id="un__notification-title" name="title" required minlength="4" maxlength="50">
            </div>

            <div>
                <label for="un__notification-content">Content</label>
                <textarea id="un__notification-description" name="content" required minlength="4" maxlength="700"></textarea>
            </div>

            <div>
                <button class="button button-disabled" data-button="un__sendNotification">Send notification</button>
                <div class="spinner"></div>
            </div>
        </form>
    </section>

    <section id="un__users-wrapper">
        <p class="un__users-selected-container">
            Selected: <span class="un__users-selected">0</span> / <?= sizeof($users) ?>
            <button class="button" data-button="un__select-all-users">Select all</button>
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
    </section>
</div>


