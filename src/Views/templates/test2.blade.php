<h1>Testing blade</h1>
@php
    var_dump($notifications);
@endphp

@if ($notifications->have_posts())
    <section id="un-notifications__basic-template">
        @foreach ($notifications->posts as $notification)
            <article class="un-notification">
                @if (has_post_thumbnail($notification))
                    <img class="un-notification__image" src="{{ get_the_post_thumbnail_url($notification) }}"
                         alt="{{ get_the_post_thumbnail_caption($notification) ?: get_the_title($notification) }}">
                @endif
                <h3 class="un-notification__title">
                    <a href="{{ get_the_permalink($notification) }}">
                        {{ get_the_title($notification) }}
                    </a>
                </h3>
                <p class="un-notification__excerpt">
                    {{ get_the_excerpt($notification) }}
                </p>
                <div class="un-notification__information">
                    <ul>
                        <li>
                            {{ get_the_author() }}
                        </li>
                        <li>
                            {{ get_the_date() }}
                        </li>
                    </ul>
                </div>
            </article>
        @endforeach
    </section>
@else
    <p>{{ __('Nothing to show yet', DOMAIN) }}</p>
@endif