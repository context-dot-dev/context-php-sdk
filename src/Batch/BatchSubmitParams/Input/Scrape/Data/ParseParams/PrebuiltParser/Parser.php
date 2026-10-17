<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ParseParams\PrebuiltParser;

/**
 * google-maps parses Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language. google-maps-reviews returns the reviews of a place in data.reviews, in the same shape as the Serper reviews API (rating, date, isoDate, snippet, translatedSnippet, likes, user, media, response, link, id), plus language, guided ratings in details, and user.isLocalGuide; data also carries the place featureId, cid, and sort. sort and limit pick the order and count, and oldest is exact. It accepts Maps place, search, and ?cid= URLs, plus search.google.com/local/reviews URLs, so the google_maps_url and google_reviews_url fields of google-maps results work as input. An unknown place returns no reviews. google-play parses a Play Store app into data: details, developer contact, ratings, price, permissions, and data safety. google-play-reviews returns the 200 newest reviews of the app, with developer replies, in data.reviews. Both Play parsers accept app details URLs (play.google.com/store/apps/details?id=…); hl and gl set the language and storefront, defaulting to en and us. app-store parses an App Store app into data: details, developer, ratings, price, version, and screenshots. app-store-reviews returns up to the 500 newest reviews in data.reviews. Both App Store parsers accept app URLs (apps.apple.com/us/app/…/id…); the country in the path sets the storefront, defaulting to us. emails accepts any page and returns its email addresses as data.emails ([{ email }]), read from mailto links, Cloudflare-protected addresses, and visible text. phone-numbers accepts any page and returns its valid phone numbers in E.164 as data.phone_numbers ([{ phone }]), read from tel links and visible text; numbers without a country code are read for the country of the site TLD, defaulting to US. links accepts any page and returns its unique http(s) links as data.links ([{ url, text }]), with absolute URLs; text falls back to aria-label or image alt and is null when a link has none. The emails parser reads the rendered page and respects content filters; the other prebuilt parsers read their data independently of DOM filters.
 */
enum Parser: string
{
    case GOOGLE_MAPS = 'google-maps';

    case GOOGLE_MAPS_REVIEWS = 'google-maps-reviews';

    case GOOGLE_PLAY = 'google-play';

    case GOOGLE_PLAY_REVIEWS = 'google-play-reviews';

    case APP_STORE = 'app-store';

    case APP_STORE_REVIEWS = 'app-store-reviews';

    case EMAILS = 'emails';

    case PHONE_NUMBERS = 'phone-numbers';

    case LINKS = 'links';
}
