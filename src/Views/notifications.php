<?php

use UserNotifications\Classes\NotificationCPT;

$isAdmin = current_user_can('manage_options');

$notifications = new WP_Query( [
	'post_type'  => NotificationCPT::POST_TYPE,
	'meta_query' => [
		[
			'key'     => 'users',
			'value'   => sprintf(':"%s";', get_current_user_id()),
			'compare' => 'LIKE'
		]
	]
] );

if ( $isAdmin ) {
	$notifications = new WP_Query( [
		'post_type'  => NotificationCPT::POST_TYPE,
	] );
}

?>

<h1>Notifications</h1>

<section id="un__notifications">
	<?php if ( $notifications->have_posts() ): ?>
		<?php while ( $notifications->have_posts() ): $notifications->the_post(); ?>
            <div class="card">
                <p class="un__card-title">
		            <?= sanitize_text_field(get_the_title()); ?>
                </p>
                <p class="un__card-description">
                    <?= sanitize_text_field(get_the_content()); ?>
                </p>
                <?php if ( $isAdmin ): ?>
                    <div class="un__card-actions">
                        <button data-button="un__removeNotification" data-notificationid="<?= get_the_ID(); ?>">
                            <?php _e('Remove notification', 'un'); ?>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php else: ?>
        <p>
            <?php _e( 'There is no notifications for you', 'un' ); ?>
        </p>
	<?php endif; ?>
</section>