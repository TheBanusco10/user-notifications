<?php if ( $notifications->have_posts() ): ?>
    <section id="un-notifications__basic-template">
		<?php while ( $notifications->have_posts() ): $notifications->the_post(); ?>
            <article class="un-notification">
				<?php if ( has_post_thumbnail() ): ?>
                    <img class="un-notification__image" src="<?= get_the_post_thumbnail_url() ?>"
                         alt="<?= get_the_post_thumbnail_caption() ?: get_the_title() ?>">
				<?php endif; ?>
                <h3 class="un-notification__title">
                    <a href="<?= get_the_permalink() ?>">
						<?= get_the_title() ?>
                    </a>
                </h3>
                <p class="un-notification__excerpt">
					<?= get_the_excerpt() ?>
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
            </article>
		<?php endwhile; ?>
    </section>
<?php else: ?>
    <p>Nothing to show yet.</p>
<?php endif; ?>