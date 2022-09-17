<h1>Testing blade</h1>
<?php
    var_dump($notifications);
?>

<?php if($notifications->have_posts()): ?>
    <section id="un-notifications__basic-template">
        <?php $__currentLoopData = $notifications->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="un-notification">
                <?php if(has_post_thumbnail($notification)): ?>
                    <img class="un-notification__image" src="<?php echo e(get_the_post_thumbnail_url($notification)); ?>"
                         alt="<?php echo e(get_the_post_thumbnail_caption($notification) ?: get_the_title($notification)); ?>">
                <?php endif; ?>
                <h3 class="un-notification__title">
                    <a href="<?php echo e(get_the_permalink($notification)); ?>">
                        <?php echo e(get_the_title($notification)); ?>

                    </a>
                </h3>
                <p class="un-notification__excerpt">
                    <?php echo e(get_the_excerpt($notification)); ?>

                </p>
                <div class="un-notification__information">
                    <ul>
                        <li>
                            <?php echo e(get_the_author()); ?>

                        </li>
                        <li>
                            <?php echo e(get_the_date()); ?>

                        </li>
                    </ul>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
<?php else: ?>
    <p><?php echo e(__('Nothing to show yet', DOMAIN)); ?></p>
<?php endif; ?><?php /**PATH C:\Users\Banus\Local Sites\plugins\app\public\wp-content\plugins\user-notifications\src\Views\templates/basic_template.blade.php ENDPATH**/ ?>