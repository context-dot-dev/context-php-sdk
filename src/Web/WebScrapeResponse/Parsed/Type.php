<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Parsed;

/**
 * The selected prebuilt parser name, or custom when type is omitted, custom rules are used, or parsing is not requested.
 */
enum Type: string
{
    case CUSTOM = 'custom';

    case GOOGLE_MAPS = 'google-maps';

    case GOOGLE_MAPS_REVIEWS = 'google-maps-reviews';

    case GOOGLE_PLAY = 'google-play';

    case GOOGLE_PLAY_REVIEWS = 'google-play-reviews';

    case APP_STORE = 'app-store';

    case APP_STORE_REVIEWS = 'app-store-reviews';

    case G2_REVIEWS = 'g2-reviews';

    case INSTAGRAM_PROFILE = 'instagram-profile';

    case INSTAGRAM_POST = 'instagram-post';

    case INSTAGRAM_FEED = 'instagram-feed';

    case EMAILS = 'emails';

    case PHONE_NUMBERS = 'phone-numbers';

    case LINKS = 'links';
}
