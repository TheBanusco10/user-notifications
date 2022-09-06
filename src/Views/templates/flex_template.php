<?php if ( $notifications->have_posts() ): ?>
    <section id="un-notifications__flex-template">
		<?php while ( $notifications->have_posts() ): $notifications->the_post(); ?>
            <article class="un-notification">
                <a href="<?= get_the_permalink() ?>">
					<?php if ( has_post_thumbnail() ): ?>
                        <img class="un-notification__image" src="<?= get_the_post_thumbnail_url() ?>"
                             alt="<?= get_the_post_thumbnail_caption() ?: get_the_title() ?>">
					<?php else: ?>
                        <div class="un-notification__image-placeholder"></div>
					<?php endif; ?>
                    <h3 class="un-notification__title">
						<?= get_the_title() ?>
                    </h3>
                    <div class="un-notification__content">
                        <p class="un-notification__excerpt">
							<?= wp_trim_words( get_the_excerpt(), 15 ) ?>
                        </p>
                        <div class="un-notification__information">
                            <ul>
                                <li>
									<?= get_the_author() ?>
                                </li>
                                <li>
									<?= get_the_date() ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </a>
            </article>
		<?php endwhile; ?>
    </section>
<?php else: ?>
    <p>Nothing to show yet.</p>
<?php endif; ?>