<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ParseParams\PrebuiltParser\Parser;
use ContextDev\Web\WebScrapeParams\ParseParams\PrebuiltParser\Sort;

/**
 * @phpstan-type PrebuiltParserShape = array{
 *   parser: Parser|value-of<Parser>,
 *   type: 'prebuilt',
 *   limit?: int|null,
 *   sort?: null|Sort|value-of<Sort>,
 * }
 */
final class PrebuiltParser implements BaseModel
{
    /** @use SdkModel<PrebuiltParserShape> */
    use SdkModel;

    /**
     * Use a prebuilt parser instead of custom rules.
     *
     * @var 'prebuilt' $type
     */
    #[Required]
    public string $type = 'prebuilt';

    /**
     * google-maps parses Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language. google-maps-reviews returns the reviews of a place in data.reviews, in the same shape as the Serper reviews API (rating, date, isoDate, snippet, translatedSnippet, likes, user, media, response, link, id), plus language, guided ratings in details, and user.isLocalGuide; data also carries the place featureId, cid, and sort. sort and limit pick the order and count, and oldest is exact. It accepts Maps place, search, and ?cid= URLs, plus search.google.com/local/reviews URLs, so the google_maps_url and google_reviews_url fields of google-maps results work as input. An unknown place returns no reviews. google-play parses a Play Store app into data: details, developer contact, ratings, price, permissions, and data safety. google-play-reviews returns the 200 newest reviews of the app, with developer replies, in data.reviews. Both Play parsers accept app details URLs (play.google.com/store/apps/details?id=…); hl and gl set the language and storefront, defaulting to en and us. app-store parses an App Store app into data: details, developer, ratings, price, version, and screenshots. app-store-reviews returns up to the 500 newest reviews in data.reviews. Both App Store parsers accept app URLs (apps.apple.com/us/app/…/id…); the country in the path sets the storefront, defaulting to us. g2-reviews returns the 25 most recently published reviews of a G2 product in data.reviews (rating, title, likes, dislikes, problems_solved, reviewer role, company size, and industry), plus data.product. It accepts G2 product URLs (g2.com/products/…), follows renamed products, and keeps star-rating filters from the URL (filters[nps_score][]=1 to 5); other filters, sort orders, and pages are ignored. instagram-profile parses a public profile (instagram.com/{username}) into data: bio, links, follower and post counts, category, business address, similar_accounts, and latest_posts (the 12 newest). instagram-post parses a post or reel (/p/…, /reel/…) into data: caption, hashtags, mentions, like, comment, and view counts, media URLs, tagged users, collaborators, location, and the top ~14 comments in data.comments. instagram-feed returns the top posts for a hashtag or keyword (/explore/tags/…, /popular/…) or the recent posts at a location (/explore/locations/{id}/…) in data.posts; keyword posts carry only the shortcode, owner, thumbnail, and views, plus the caption when Instagram shows it. All three Instagram parsers read public data without logging in, so private accounts return no posts and follower lists are unavailable. emails accepts any page and returns its email addresses as data.emails ([{ email }]), read from mailto links, Cloudflare-protected addresses, and visible text. phone-numbers accepts any page and returns its valid phone numbers in E.164 as data.phone_numbers ([{ phone }]), read from tel links and visible text; numbers without a country code are read for the country of the site TLD, defaulting to US. links accepts any page and returns its unique http(s) links as data.links ([{ url, text }]), with absolute URLs; text falls back to aria-label or image alt and is null when a link has none. The emails parser reads the rendered page and respects content filters; the other prebuilt parsers read their data independently of DOM filters.
     *
     * @var value-of<Parser> $parser
     */
    #[Required(enum: Parser::class)]
    public string $parser;

    /**
     * google-maps-reviews only. Maximum number of reviews to return. Defaults to 100; maximum 1000.
     */
    #[Optional]
    public ?int $limit;

    /**
     * google-maps-reviews only. Order of data.reviews. newest, relevant, highest, and lowest follow Google; oldest returns the earliest reviews first, which Google itself does not offer.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    /**
     * `new PrebuiltParser()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PrebuiltParser::with(parser: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PrebuiltParser)->withParser(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Parser|value-of<Parser> $parser
     * @param Sort|value-of<Sort>|null $sort
     */
    public static function with(
        Parser|string $parser,
        ?int $limit = null,
        Sort|string|null $sort = null
    ): self {
        $self = new self;

        $self['parser'] = $parser;

        null !== $limit && $self['limit'] = $limit;
        null !== $sort && $self['sort'] = $sort;

        return $self;
    }

    /**
     * google-maps parses Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language. google-maps-reviews returns the reviews of a place in data.reviews, in the same shape as the Serper reviews API (rating, date, isoDate, snippet, translatedSnippet, likes, user, media, response, link, id), plus language, guided ratings in details, and user.isLocalGuide; data also carries the place featureId, cid, and sort. sort and limit pick the order and count, and oldest is exact. It accepts Maps place, search, and ?cid= URLs, plus search.google.com/local/reviews URLs, so the google_maps_url and google_reviews_url fields of google-maps results work as input. An unknown place returns no reviews. google-play parses a Play Store app into data: details, developer contact, ratings, price, permissions, and data safety. google-play-reviews returns the 200 newest reviews of the app, with developer replies, in data.reviews. Both Play parsers accept app details URLs (play.google.com/store/apps/details?id=…); hl and gl set the language and storefront, defaulting to en and us. app-store parses an App Store app into data: details, developer, ratings, price, version, and screenshots. app-store-reviews returns up to the 500 newest reviews in data.reviews. Both App Store parsers accept app URLs (apps.apple.com/us/app/…/id…); the country in the path sets the storefront, defaulting to us. g2-reviews returns the 25 most recently published reviews of a G2 product in data.reviews (rating, title, likes, dislikes, problems_solved, reviewer role, company size, and industry), plus data.product. It accepts G2 product URLs (g2.com/products/…), follows renamed products, and keeps star-rating filters from the URL (filters[nps_score][]=1 to 5); other filters, sort orders, and pages are ignored. instagram-profile parses a public profile (instagram.com/{username}) into data: bio, links, follower and post counts, category, business address, similar_accounts, and latest_posts (the 12 newest). instagram-post parses a post or reel (/p/…, /reel/…) into data: caption, hashtags, mentions, like, comment, and view counts, media URLs, tagged users, collaborators, location, and the top ~14 comments in data.comments. instagram-feed returns the top posts for a hashtag or keyword (/explore/tags/…, /popular/…) or the recent posts at a location (/explore/locations/{id}/…) in data.posts; keyword posts carry only the shortcode, owner, thumbnail, and views, plus the caption when Instagram shows it. All three Instagram parsers read public data without logging in, so private accounts return no posts and follower lists are unavailable. emails accepts any page and returns its email addresses as data.emails ([{ email }]), read from mailto links, Cloudflare-protected addresses, and visible text. phone-numbers accepts any page and returns its valid phone numbers in E.164 as data.phone_numbers ([{ phone }]), read from tel links and visible text; numbers without a country code are read for the country of the site TLD, defaulting to US. links accepts any page and returns its unique http(s) links as data.links ([{ url, text }]), with absolute URLs; text falls back to aria-label or image alt and is null when a link has none. The emails parser reads the rendered page and respects content filters; the other prebuilt parsers read their data independently of DOM filters.
     *
     * @param Parser|value-of<Parser> $parser
     */
    public function withParser(Parser|string $parser): self
    {
        $self = clone $this;
        $self['parser'] = $parser;

        return $self;
    }

    /**
     * Use a prebuilt parser instead of custom rules.
     *
     * @param 'prebuilt' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * google-maps-reviews only. Maximum number of reviews to return. Defaults to 100; maximum 1000.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * google-maps-reviews only. Order of data.reviews. newest, relevant, highest, and lowest follow Google; oldest returns the earliest reviews first, which Google itself does not offer.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

        return $self;
    }
}
