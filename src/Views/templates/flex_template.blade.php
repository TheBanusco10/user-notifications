@if ($notifications->have_posts())
    <section id="un-notifications__flex-template">
        @foreach ($notifications->posts as $notification)
            <article class="un-notification">
                <a href="{{ get_the_permalink($notification) }}">
                    @if (has_post_thumbnail($notification))
                        <img class="un-notification__image" src="{{ get_the_post_thumbnail_url($notification) }}"
                             alt="{{ get_the_post_thumbnail_caption($notification) ?: get_the_title($notification) }}">
                    @else
                        <div class="un-notification__image-placeholder"></div>
                    @endif
                    <h3 class="un-notification__title">
                        {{ get_the_title($notification) }}
                    </h3>
                    <div class="un-notification__content">
                        <p class="un-notification__excerpt">
                            {!! wp_trim_words( get_the_excerpt($notification), 15 ) !!}
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
        @endforeach
    </section>
@else
    <p>{{ __('Nothing to show yet', DOMAIN) }}</p>
@endif