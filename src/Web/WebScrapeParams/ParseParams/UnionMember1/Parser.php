<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1;

/**
 * google-maps parses Google Maps business data into data.results. Accepts Maps place, search, and internal data URLs. Uses a US exit and English labels regardless of hl or Accept-Language. google-maps-reviews returns the reviews of a place in data.reviews, in the same shape as the Serper reviews API (rating, date, isoDate, snippet, translatedSnippet, likes, user, media, response, link, id), plus language, guided ratings in details, and user.isLocalGuide; data also carries the place featureId, cid, and sort. sort and limit pick the order and count, and oldest is exact. It accepts Maps place, search, and ?cid= URLs, plus search.google.com/local/reviews URLs, so the google_maps_url and google_reviews_url fields of google-maps results work as input. An unknown place returns no reviews. google-play parses a Play Store app into data: details, developer contact, ratings, price, permissions, and data safety. google-play-reviews returns the 200 newest reviews of the app, with developer replies, in data.reviews. Both Play parsers accept app details URLs (play.google.com/store/apps/details?id=…); hl and gl set the language and storefront, defaulting to en and us. app-store parses an App Store app into data: details, developer, ratings, price, version, and screenshots. app-store-reviews returns up to the 500 newest reviews in data.reviews. Both App Store parsers accept app URLs (apps.apple.com/us/app/…/id…); the country in the path sets the storefront, defaulting to us. g2-reviews returns the 25 most recently published reviews of a G2 product in data.reviews (rating, title, likes, dislikes, problems_solved, reviewer role, company size, and industry), plus data.product. It accepts G2 product URLs (g2.com/products/…), follows renamed products, and keeps star-rating filters from the URL (filters[nps_score][]=1 to 5); other filters, sort orders, and pages are ignored. instagram-profile parses a public profile (instagram.com/{username}) into data: bio, links, follower and post counts, category, business address, similar_accounts, and latest_posts (up to the 12 posts at the top of the profile, newest first). Instagram lists pinned posts there ahead of newer ones, so posts with is_pinned true can be older; when Instagram shows only a rounded post count (32K), post_count is that rounded number and is_post_count_rounded is true. instagram-post parses a post or reel (/p/…, /reel/…) into data: caption, hashtags, mentions, like, comment, and view counts (like_count and view_count are null when the owner hides them), media URLs, tagged users, collaborators, location, and the top ~14 comments in data.comments. instagram-feed returns the top posts for a hashtag or keyword (/explore/tags/…, /popular/…) or the recent posts at a location (/explore/locations/{id}/…) in data.posts; keyword posts carry only the shortcode, owner, thumbnail, and views, plus the caption when Instagram shows it. All three Instagram parsers read public data without logging in, so private accounts return no posts and follower lists are unavailable. tiktok-profile parses a public profile (tiktok.com/@{username}) into data: nickname, bio, bio link, follower, following, like, and video counts, verified, private, and business flags, and business category; it does not list videos. tiktok-video parses a video or photo post (/@{username}/video/{id} or /@{username}/photo/{id}) into data: caption, hashtags, mentions, author, view, like, comment, share, save, and repost counts, duration, thumbnail, a video_url that downloads without cookies, image_urls for photo posts, music, location, and ad, paid-partnership, and AI-generated flags. tiktok-feed returns videos in the tiktok-video shape as data.videos: the latest 15 from a profile URL, the top 30 from a hashtag URL (/tag/{name}), or the top 12 from a search URL (/search?q={query}). tiktok-comments returns the first 20 comments of a video or photo post as data.comments: text, posted_at, like and reply counts, whether the author liked it, and the commenter. tiktok-followers and tiktok-following return up to 30 accounts of a profile as data.users, in the tiktok-profile shape. tiktok-user-search returns the top 10 accounts for a user search URL (/search/user?q={query}) as data.users: id, username, nickname, biography, avatar_url, sec_uid, follower_count, like_count, and is_verified. The TikTok parsers accept tiktok.com, www.tiktok.com, and m.tiktok.com URLs but not short links (vm.tiktok.com, vt.tiktok.com, tiktok.com/t/…). yelp-search accepts Yelp search URLs with find_desc and find_loc, reads start as the result offset, and returns up to 20 ranked organic businesses in data.businesses with total and pagination. emails accepts any page and returns its email addresses as data.emails ([{ email }]), read from mailto links, Cloudflare-protected addresses, and visible text. phone-numbers accepts any page and returns its valid phone numbers in E.164 as data.phone_numbers ([{ phone }]), read from tel links and visible text; numbers without a country code are read for the country of the site TLD, defaulting to US. links accepts any page and returns its unique http(s) links as data.links ([{ url, text }]), with absolute URLs; text falls back to aria-label or image alt and is null when a link has none. The emails parser reads the rendered page and respects content filters; the other prebuilt parsers read their data independently of DOM filters.
 */
enum Parser: string
{
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

    case TIKTOK_PROFILE = 'tiktok-profile';

    case TIKTOK_VIDEO = 'tiktok-video';

    case TIKTOK_FEED = 'tiktok-feed';

    case TIKTOK_COMMENTS = 'tiktok-comments';

    case TIKTOK_FOLLOWERS = 'tiktok-followers';

    case TIKTOK_FOLLOWING = 'tiktok-following';

    case TIKTOK_USER_SEARCH = 'tiktok-user-search';

    case YELP_SEARCH = 'yelp-search';

    case EMAILS = 'emails';

    case PHONE_NUMBERS = 'phone-numbers';

    case LINKS = 'links';
}
