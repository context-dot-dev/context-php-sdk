<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1\Parser;
use ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1\Sort;

/**
 * @phpstan-type UnionMember1Shape = array{
 *   parser: Parser|value-of<Parser>,
 *   type: 'prebuilt',
 *   limit?: int|null,
 *   sort?: null|Sort|value-of<Sort>,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    /**
     * Use a prebuilt parser instead of custom rules.
     *
     * @var 'prebuilt' $type
     */
    #[Required]
    public string $type = 'prebuilt';

    /**
     * Prebuilt parser to run. Each one accepts specific URLs and returns its result in `parsed.data`. `emails`, `phone-numbers`, and `links` read the rendered page and respect content filters; the others read their source directly, independently of content filters and other outputs.
     *
     * - `google-maps`: Google Maps place, search, and internal data URLs. Returns businesses in `data.results`; a search URL returns up to 200 places. Results use the country set in the URL, or the US when none is set, and come back with English labels.
     * - `google-maps-reviews`: Google Maps place, search, and `?cid=` URLs, plus `search.google.com/local/reviews` URLs, so the `google_maps_url` and `google_reviews_url` fields of `google-maps` results work as input. Returns the reviews of the place in `data.reviews` (`rating`, `date`, `isoDate`, `snippet`, `translatedSnippet`, `likes`, `user`, `media`, `response`, `link`, `id`, `language`, guided ratings in `details`, and `user.isLocalGuide`), plus the place `featureId`, `cid`, and `sort` in `data`. `sort` and `limit` set the order and count; `oldest` is exact. An unknown place returns no reviews.
     * - `google-play`: Play Store app details URLs (`play.google.com/store/apps/details?id=…`). Returns one app in `data`: details, developer contact, ratings, price, permissions, data safety, the storefront country the record describes, and `is_available` (whether the app is offered there). Ratings are counted per storefront, so `rating`, `rating_count`, and `rating_histogram` are `null` where nobody rated the app. The language and storefront country set in the URL apply (default English and the US); without a storefront country, an app not offered in the US is read from the country of its developer.
     * - `google-play-reviews`: Same URLs as `google-play`. Returns up to the 200 newest reviews in the language set in the URL, with developer replies, in `data.reviews`; an app with fewer such reviews returns them all.
     * - `app-store`: App Store app URLs (`apps.apple.com/us/app/…/id…`). Returns one app in `data`: details, developer, ratings, price, version, and screenshots. The country in the path sets the storefront (default `us`).
     * - `app-store-reviews`: Same URLs as `app-store`. Returns up to the 500 newest reviews in `data.reviews`.
     * - `g2-reviews`: G2 product URLs (`g2.com/products/…`), following renamed products. Returns the 25 most recently published reviews in `data.reviews` (rating, title, likes, dislikes, `problems_solved`, reviewer role, company size, and industry), plus `data.product`. Keeps star-rating filters from the URL (`filters[nps_score][]=1` to `5`) and ignores other filters, sort orders, and pages.
     * - `instagram-profile`: Public profile URLs (`instagram.com/{username}`). Returns one profile in `data`: bio, links, follower and post counts, category, business address, `similar_accounts`, and `latest_posts` (up to the 12 posts at the top of the profile, newest first). Instagram lists pinned posts first, so posts with `is_pinned: true` can be older. When Instagram shows only a rounded post count (such as 32K), `post_count` is that rounded number and `is_post_count_rounded` is `true`.
     * - `instagram-post`: Post and reel URLs (`/p/…`, `/reel/…`). Returns one post in `data`: caption, hashtags, mentions, like, comment, and view counts (`like_count` and `view_count` are `null` when the owner hides them), media URLs, tagged users, collaborators, location, and about the top 14 comments in `data.comments`.
     * - `instagram-feed`: Hashtag and keyword URLs (`/explore/tags/…`, `/popular/…`) return the top posts; location URLs (`/explore/locations/{id}/…`) return recent posts. Posts are in `data.posts`; keyword posts carry only the shortcode, owner, thumbnail, and views, plus the caption when Instagram shows it. All three Instagram parsers read public data without signing in, so private accounts return no posts and follower lists are unavailable.
     * - `tiktok-profile`: Public profile URLs (`tiktok.com/@{username}`). Returns one profile in `data`: nickname, bio, bio link, follower, following, like, and video counts, verified, private, and business flags, and business category. Does not list videos.
     * - `tiktok-video`: Video and photo post URLs (`/@{username}/video/{id}`, `/@{username}/photo/{id}`). Returns one post in `data`: caption, hashtags, mentions, author, view, like, comment, share, save, and repost counts, duration, thumbnail, a `video_url` that downloads without cookies, `image_urls` for photo posts, music, location, and ad, paid-partnership, and AI-generated flags.
     * - `tiktok-feed`: Returns videos in the `tiktok-video` shape in `data.videos`: the latest 15 from a profile URL, the top 30 from a hashtag URL (`/tag/{name}`), or the top 12 from a search URL (`/search?q={query}`).
     * - `tiktok-comments`: Video and photo post URLs. Returns the first 20 comments in `data.comments`: text, `posted_at`, like and reply counts, whether the author liked it, and the commenter.
     * - `tiktok-followers`, `tiktok-following`: Profile URLs. Return up to 30 accounts in `data.users`, in the `tiktok-profile` shape.
     * - `tiktok-user-search`: User search URLs (`/search/user?q={query}`). Returns the top 10 accounts in `data.users`: `id`, `username`, `nickname`, `biography`, `avatar_url`, `sec_uid`, `follower_count`, `like_count`, and `is_verified`. The TikTok parsers accept `tiktok.com`, `www.tiktok.com`, and `m.tiktok.com` URLs, not short links (`vm.tiktok.com`, `vt.tiktok.com`, `tiktok.com/t/…`).
     * - `reddit-post`: Post URLs (`reddit.com/r/{subreddit}/comments/{id}`, `reddit.com/comments/{id}`, `redd.it/{id}`). Returns the post in `data.post`: title, body as Markdown, type (`text`, `link`, `image`, `gallery`, or `video`), `link_url`, subreddit, author, flairs, score, `upvote_ratio`, comment and crosspost counts, NSFW, spoiler, locked, stickied, and archived flags, images (every gallery image in order), and video (an MP4 `url` plus an `hls_url` that carries the audio). `data.comments` holds the comment tree; each comment has `id`, `author`, `body` (Markdown), `score`, `posted_at`, `depth`, `parent_id`, `url`, `is_submitter`, `is_deleted`, and its `replies`. `limit` caps the total number of comments (default 100), filled shallowest first so whole conversations are kept, and `data.has_more_comments` says whether the thread has more. The `sort` in the URL (`best`, `top`, `new`, `controversial`, `old`, `qa`) orders the comments.
     * - `reddit-search`: Search URLs (`reddit.com/search?q={query}`, or `reddit.com/r/{subreddit}/search?q={query}` to search one subreddit). With `type=link` or no `type`, returns posts in the `reddit-post` shape in `data.posts`, ordered by the `sort` in the URL (`relevance`, `hot`, `top`, `new`, `comments`) within its `t` time range (`hour`, `day`, `week`, `month`, `year`, `all`). `type=sr` returns communities in `data.communities` (name, title, description, sidebar, `subscriber_count`, `created_at`, type, NSFW and quarantine flags, language, category, icon and banner URLs, and allowed post types). `type=user` returns accounts in `data.users` (username, `display_name`, bio, `created_at`, post and comment karma, avatar and banner URLs, and verified, employee, moderator, premium, and NSFW flags). `limit` caps the number of results (default 100), in the order Reddit returns them, and `data.has_more` says whether Reddit has more.
     * - `reddit-subreddit`: Subreddit URLs (`reddit.com/r/{subreddit}`, optionally followed by `/hot`, `/new`, `/top`, `/rising`, or `/controversial`, with `t` setting the time range of `top` and `controversial`, default `day`). Returns `data.subreddit` in the community shape of `reddit-search`, `data.rules` (`name`, `description`, `applies_to`, `violation_reason`, `created_at`), and `data.posts` in the `reddit-post` shape, ordered like the tab (default `hot`) with stickied posts flagged. `r/all` and `r/popular` return posts with `null` `subreddit` and `rules`. `limit` caps the posts (default 100) and `data.has_more` says whether Reddit has more. Private and quarantined subreddits return `WEBSITE_ACCESS_ERROR`.
     * - `reddit-user`: Profile URLs (`reddit.com/user/{username}` or `reddit.com/u/{username}`, optionally followed by `/overview`, `/submitted`, or `/comments`, with `sort` set to `new`, `hot`, `top`, or `controversial` and `t` setting the time range of `top` and `controversial`, default `all`). Returns `data.user` (`id`, `username`, `display_name`, bio, `created_at`, total, post, comment, awardee, and awarder karma, avatar and banner URLs, and verified, suspended, employee, moderator, premium, and NSFW flags), `data.trophies` (`name`, `description`, `icon_url`, `granted_at`, `url`), `data.moderated_communities` (`name`, `title`, `url`, `subscriber_count`, `icon_url`, `is_nsfw`), `data.posts` in the `reddit-post` shape, and `data.comments`, each with `id`, `author`, `body` (Markdown), `score`, `posted_at`, `edited_at`, `url`, `subreddit`, `parent_id` (`null` for a top-level comment), `is_submitter`, `is_stickied`, `distinguished`, `award_count`, and the post it was left on (`id`, `title`, `url`, `author`, `is_nsfw`). The overview tab returns both posts and comments; `submitted` returns `null` comments and `comments` returns `null` posts. `limit` caps posts and comments together (default 100) and `data.has_more` says whether Reddit has more. Users who hide their activity return empty lists, and suspended accounts return their profile with `null` posts and comments.
     * - `yelp-search`: Yelp search URLs with `find_desc` and `find_loc`; `start` sets the result offset. Returns up to 20 ranked organic businesses in `data.businesses`, with `total` and `pagination`.
     * - `yelp-reviews`: Yelp business URLs (`yelp.com/biz/{alias}`); optional `start` sets the offset. Returns up to 20 of the latest public reviews, always newest first, in `data.reviews`, with business details and `pagination.next_offset`. Each review has rating, full text, `updated_at`, and author (`id` from the reviewer profile URL, `url` linking to that profile, `name`, `location`, and `review_count`); owner replies and photos are not included. Unsupported sort and review filters are rejected; tracking parameters are ignored.
     * - `tripadvisor-reviews`: Tripadvisor hotel, restaurant, and attraction review URLs (`tripadvisor.com/Hotel_Review-g{geo}-d{id}-Reviews-….html`, on any Tripadvisor country domain); `-or{N}-` in the path sets the offset. Returns 20 reviews in `data.reviews` in the order Tripadvisor shows them, with `data.location` (`id`, `name`, `type`, `url`, `review_count`) and `pagination.next_offset`. Each review has `id`, `url`, `title`, full text, `rating`, `language`, `published_at`, `visit_month`, `helpful_votes`, `subratings`, `photo_urls`, `owner_response` (`text`, `published_at`, `author_name`), and `author` (`id`, `username`, `name`, `url`, `contribution_count`). An unknown location returns no reviews.
     * - `car-rental-availability`: avis.com and budget.com vehicle-availability search URLs. Returns every vehicle with pay-now and pay-later prices in `data.vehicles`.
     * - `car-rental-locations`: avis.com and budget.com `/locations?keyword=` URLs. Returns rental branches with codes, addresses, coordinates, and hours in `data.locations`.
     * - `emails`: Any page. Returns its email addresses in `data.emails` (`[{ email }]`), read from `mailto:` links, Cloudflare-protected addresses, and visible text.
     * - `phone-numbers`: Any page. Returns its valid phone numbers in E.164 format in `data.phone_numbers` (`[{ phone }]`), read from `tel:` links and visible text. Numbers without a country code are read for the country of the site TLD (US by default).
     * - `links`: Any page. Returns its unique HTTP and HTTPS links as absolute URLs in `data.links` (`[{ url, text }]`). `text` falls back to `aria-label` or image alt text and is `null` when a link has none.
     *
     * @var value-of<Parser> $parser
     */
    #[Required(enum: Parser::class)]
    public string $parser;

    /**
     * Maximum number of reviews (`google-maps-reviews`, default 100), comments (`reddit-post`, default 100), or results (`reddit-search`, `reddit-subreddit`, and `reddit-user`, default 100) to return. Only these parsers accept it.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Order of `data.reviews` for `google-maps-reviews`. `newest`, `relevant`, `highest`, and `lowest` use the same orders as Google Maps; `oldest` returns the earliest reviews first.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    /**
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(parser: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)->withParser(...)
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
     * Prebuilt parser to run. Each one accepts specific URLs and returns its result in `parsed.data`. `emails`, `phone-numbers`, and `links` read the rendered page and respect content filters; the others read their source directly, independently of content filters and other outputs.
     *
     * - `google-maps`: Google Maps place, search, and internal data URLs. Returns businesses in `data.results`; a search URL returns up to 200 places. Results use the country set in the URL, or the US when none is set, and come back with English labels.
     * - `google-maps-reviews`: Google Maps place, search, and `?cid=` URLs, plus `search.google.com/local/reviews` URLs, so the `google_maps_url` and `google_reviews_url` fields of `google-maps` results work as input. Returns the reviews of the place in `data.reviews` (`rating`, `date`, `isoDate`, `snippet`, `translatedSnippet`, `likes`, `user`, `media`, `response`, `link`, `id`, `language`, guided ratings in `details`, and `user.isLocalGuide`), plus the place `featureId`, `cid`, and `sort` in `data`. `sort` and `limit` set the order and count; `oldest` is exact. An unknown place returns no reviews.
     * - `google-play`: Play Store app details URLs (`play.google.com/store/apps/details?id=…`). Returns one app in `data`: details, developer contact, ratings, price, permissions, data safety, the storefront country the record describes, and `is_available` (whether the app is offered there). Ratings are counted per storefront, so `rating`, `rating_count`, and `rating_histogram` are `null` where nobody rated the app. The language and storefront country set in the URL apply (default English and the US); without a storefront country, an app not offered in the US is read from the country of its developer.
     * - `google-play-reviews`: Same URLs as `google-play`. Returns up to the 200 newest reviews in the language set in the URL, with developer replies, in `data.reviews`; an app with fewer such reviews returns them all.
     * - `app-store`: App Store app URLs (`apps.apple.com/us/app/…/id…`). Returns one app in `data`: details, developer, ratings, price, version, and screenshots. The country in the path sets the storefront (default `us`).
     * - `app-store-reviews`: Same URLs as `app-store`. Returns up to the 500 newest reviews in `data.reviews`.
     * - `g2-reviews`: G2 product URLs (`g2.com/products/…`), following renamed products. Returns the 25 most recently published reviews in `data.reviews` (rating, title, likes, dislikes, `problems_solved`, reviewer role, company size, and industry), plus `data.product`. Keeps star-rating filters from the URL (`filters[nps_score][]=1` to `5`) and ignores other filters, sort orders, and pages.
     * - `instagram-profile`: Public profile URLs (`instagram.com/{username}`). Returns one profile in `data`: bio, links, follower and post counts, category, business address, `similar_accounts`, and `latest_posts` (up to the 12 posts at the top of the profile, newest first). Instagram lists pinned posts first, so posts with `is_pinned: true` can be older. When Instagram shows only a rounded post count (such as 32K), `post_count` is that rounded number and `is_post_count_rounded` is `true`.
     * - `instagram-post`: Post and reel URLs (`/p/…`, `/reel/…`). Returns one post in `data`: caption, hashtags, mentions, like, comment, and view counts (`like_count` and `view_count` are `null` when the owner hides them), media URLs, tagged users, collaborators, location, and about the top 14 comments in `data.comments`.
     * - `instagram-feed`: Hashtag and keyword URLs (`/explore/tags/…`, `/popular/…`) return the top posts; location URLs (`/explore/locations/{id}/…`) return recent posts. Posts are in `data.posts`; keyword posts carry only the shortcode, owner, thumbnail, and views, plus the caption when Instagram shows it. All three Instagram parsers read public data without signing in, so private accounts return no posts and follower lists are unavailable.
     * - `tiktok-profile`: Public profile URLs (`tiktok.com/@{username}`). Returns one profile in `data`: nickname, bio, bio link, follower, following, like, and video counts, verified, private, and business flags, and business category. Does not list videos.
     * - `tiktok-video`: Video and photo post URLs (`/@{username}/video/{id}`, `/@{username}/photo/{id}`). Returns one post in `data`: caption, hashtags, mentions, author, view, like, comment, share, save, and repost counts, duration, thumbnail, a `video_url` that downloads without cookies, `image_urls` for photo posts, music, location, and ad, paid-partnership, and AI-generated flags.
     * - `tiktok-feed`: Returns videos in the `tiktok-video` shape in `data.videos`: the latest 15 from a profile URL, the top 30 from a hashtag URL (`/tag/{name}`), or the top 12 from a search URL (`/search?q={query}`).
     * - `tiktok-comments`: Video and photo post URLs. Returns the first 20 comments in `data.comments`: text, `posted_at`, like and reply counts, whether the author liked it, and the commenter.
     * - `tiktok-followers`, `tiktok-following`: Profile URLs. Return up to 30 accounts in `data.users`, in the `tiktok-profile` shape.
     * - `tiktok-user-search`: User search URLs (`/search/user?q={query}`). Returns the top 10 accounts in `data.users`: `id`, `username`, `nickname`, `biography`, `avatar_url`, `sec_uid`, `follower_count`, `like_count`, and `is_verified`. The TikTok parsers accept `tiktok.com`, `www.tiktok.com`, and `m.tiktok.com` URLs, not short links (`vm.tiktok.com`, `vt.tiktok.com`, `tiktok.com/t/…`).
     * - `reddit-post`: Post URLs (`reddit.com/r/{subreddit}/comments/{id}`, `reddit.com/comments/{id}`, `redd.it/{id}`). Returns the post in `data.post`: title, body as Markdown, type (`text`, `link`, `image`, `gallery`, or `video`), `link_url`, subreddit, author, flairs, score, `upvote_ratio`, comment and crosspost counts, NSFW, spoiler, locked, stickied, and archived flags, images (every gallery image in order), and video (an MP4 `url` plus an `hls_url` that carries the audio). `data.comments` holds the comment tree; each comment has `id`, `author`, `body` (Markdown), `score`, `posted_at`, `depth`, `parent_id`, `url`, `is_submitter`, `is_deleted`, and its `replies`. `limit` caps the total number of comments (default 100), filled shallowest first so whole conversations are kept, and `data.has_more_comments` says whether the thread has more. The `sort` in the URL (`best`, `top`, `new`, `controversial`, `old`, `qa`) orders the comments.
     * - `reddit-search`: Search URLs (`reddit.com/search?q={query}`, or `reddit.com/r/{subreddit}/search?q={query}` to search one subreddit). With `type=link` or no `type`, returns posts in the `reddit-post` shape in `data.posts`, ordered by the `sort` in the URL (`relevance`, `hot`, `top`, `new`, `comments`) within its `t` time range (`hour`, `day`, `week`, `month`, `year`, `all`). `type=sr` returns communities in `data.communities` (name, title, description, sidebar, `subscriber_count`, `created_at`, type, NSFW and quarantine flags, language, category, icon and banner URLs, and allowed post types). `type=user` returns accounts in `data.users` (username, `display_name`, bio, `created_at`, post and comment karma, avatar and banner URLs, and verified, employee, moderator, premium, and NSFW flags). `limit` caps the number of results (default 100), in the order Reddit returns them, and `data.has_more` says whether Reddit has more.
     * - `reddit-subreddit`: Subreddit URLs (`reddit.com/r/{subreddit}`, optionally followed by `/hot`, `/new`, `/top`, `/rising`, or `/controversial`, with `t` setting the time range of `top` and `controversial`, default `day`). Returns `data.subreddit` in the community shape of `reddit-search`, `data.rules` (`name`, `description`, `applies_to`, `violation_reason`, `created_at`), and `data.posts` in the `reddit-post` shape, ordered like the tab (default `hot`) with stickied posts flagged. `r/all` and `r/popular` return posts with `null` `subreddit` and `rules`. `limit` caps the posts (default 100) and `data.has_more` says whether Reddit has more. Private and quarantined subreddits return `WEBSITE_ACCESS_ERROR`.
     * - `reddit-user`: Profile URLs (`reddit.com/user/{username}` or `reddit.com/u/{username}`, optionally followed by `/overview`, `/submitted`, or `/comments`, with `sort` set to `new`, `hot`, `top`, or `controversial` and `t` setting the time range of `top` and `controversial`, default `all`). Returns `data.user` (`id`, `username`, `display_name`, bio, `created_at`, total, post, comment, awardee, and awarder karma, avatar and banner URLs, and verified, suspended, employee, moderator, premium, and NSFW flags), `data.trophies` (`name`, `description`, `icon_url`, `granted_at`, `url`), `data.moderated_communities` (`name`, `title`, `url`, `subscriber_count`, `icon_url`, `is_nsfw`), `data.posts` in the `reddit-post` shape, and `data.comments`, each with `id`, `author`, `body` (Markdown), `score`, `posted_at`, `edited_at`, `url`, `subreddit`, `parent_id` (`null` for a top-level comment), `is_submitter`, `is_stickied`, `distinguished`, `award_count`, and the post it was left on (`id`, `title`, `url`, `author`, `is_nsfw`). The overview tab returns both posts and comments; `submitted` returns `null` comments and `comments` returns `null` posts. `limit` caps posts and comments together (default 100) and `data.has_more` says whether Reddit has more. Users who hide their activity return empty lists, and suspended accounts return their profile with `null` posts and comments.
     * - `yelp-search`: Yelp search URLs with `find_desc` and `find_loc`; `start` sets the result offset. Returns up to 20 ranked organic businesses in `data.businesses`, with `total` and `pagination`.
     * - `yelp-reviews`: Yelp business URLs (`yelp.com/biz/{alias}`); optional `start` sets the offset. Returns up to 20 of the latest public reviews, always newest first, in `data.reviews`, with business details and `pagination.next_offset`. Each review has rating, full text, `updated_at`, and author (`id` from the reviewer profile URL, `url` linking to that profile, `name`, `location`, and `review_count`); owner replies and photos are not included. Unsupported sort and review filters are rejected; tracking parameters are ignored.
     * - `tripadvisor-reviews`: Tripadvisor hotel, restaurant, and attraction review URLs (`tripadvisor.com/Hotel_Review-g{geo}-d{id}-Reviews-….html`, on any Tripadvisor country domain); `-or{N}-` in the path sets the offset. Returns 20 reviews in `data.reviews` in the order Tripadvisor shows them, with `data.location` (`id`, `name`, `type`, `url`, `review_count`) and `pagination.next_offset`. Each review has `id`, `url`, `title`, full text, `rating`, `language`, `published_at`, `visit_month`, `helpful_votes`, `subratings`, `photo_urls`, `owner_response` (`text`, `published_at`, `author_name`), and `author` (`id`, `username`, `name`, `url`, `contribution_count`). An unknown location returns no reviews.
     * - `car-rental-availability`: avis.com and budget.com vehicle-availability search URLs. Returns every vehicle with pay-now and pay-later prices in `data.vehicles`.
     * - `car-rental-locations`: avis.com and budget.com `/locations?keyword=` URLs. Returns rental branches with codes, addresses, coordinates, and hours in `data.locations`.
     * - `emails`: Any page. Returns its email addresses in `data.emails` (`[{ email }]`), read from `mailto:` links, Cloudflare-protected addresses, and visible text.
     * - `phone-numbers`: Any page. Returns its valid phone numbers in E.164 format in `data.phone_numbers` (`[{ phone }]`), read from `tel:` links and visible text. Numbers without a country code are read for the country of the site TLD (US by default).
     * - `links`: Any page. Returns its unique HTTP and HTTPS links as absolute URLs in `data.links` (`[{ url, text }]`). `text` falls back to `aria-label` or image alt text and is `null` when a link has none.
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
     * Maximum number of reviews (`google-maps-reviews`, default 100), comments (`reddit-post`, default 100), or results (`reddit-search`, `reddit-subreddit`, and `reddit-user`, default 100) to return. Only these parsers accept it.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Order of `data.reviews` for `google-maps-reviews`. `newest`, `relevant`, `highest`, and `lowest` use the same orders as Google Maps; `oldest` returns the earliest reviews first.
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
