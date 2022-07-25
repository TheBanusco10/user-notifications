<?php

use UserNotifications\Classes\NotificationCPT;

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

?>

<h1>Notifications</h1>

<section id="un__notifications">
	<?php if ( $notifications->have_posts() ): ?>
		<?php while ( $notifications->have_posts() ): $notifications->the_post(); ?>
            <p>
                <?= get_the_title(); ?>
            </p>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php else: ?>
    <p>
        <?php __( 'There is no notifications yet.', 'un' ); ?>
    </p>
	<?php endif; ?>
</section>