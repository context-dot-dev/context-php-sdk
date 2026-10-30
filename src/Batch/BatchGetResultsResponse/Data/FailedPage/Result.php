<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage;

use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Bytes;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\CacheMetadata;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Highlights;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\HTML;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Images;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Json;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\KeyMetadata;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Markdown;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Metadata;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Parsed;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Product;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Profile;
use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Screenshot;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Per-format failures when scraping returned a structured response. Omitted for errors that prevent scraping.
 *
 * @phpstan-import-type BytesShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Bytes
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\CacheMetadata
 * @phpstan-import-type HighlightsShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Highlights
 * @phpstan-import-type HTMLShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\HTML
 * @phpstan-import-type ImagesShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Images
 * @phpstan-import-type JsonShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Json
 * @phpstan-import-type MarkdownShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Markdown
 * @phpstan-import-type MetadataShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Metadata
 * @phpstan-import-type ParsedShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Parsed
 * @phpstan-import-type ProductShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Product
 * @phpstan-import-type ProfileShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Profile
 * @phpstan-import-type ScreenshotShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Screenshot
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\KeyMetadata
 *
 * @phpstan-type ResultShape = array{
 *   bytes: Bytes|BytesShape,
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   highlights: Highlights|HighlightsShape,
 *   html: HTML|HTMLShape,
 *   images: Images|ImagesShape,
 *   json: Json|JsonShape,
 *   markdown: Markdown|MarkdownShape,
 *   metadata: Metadata|MetadataShape,
 *   parsed: Parsed|ParsedShape,
 *   product: Product|ProductShape,
 *   profile: null|Profile|ProfileShape,
 *   requestID: string,
 *   screenshot: Screenshot|ScreenshotShape,
 *   url: string,
 *   isPartial?: bool|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * The original HTTP response body, unchanged by waits, actions, and filters.
     */
    #[Required]
    public Bytes $bytes;

    /**
     * Whether this response came from cache.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Relevant Markdown excerpts in page order. `[Heading]` adds context; `…` marks omitted text.
     */
    #[Required]
    public Highlights $highlights;

    /**
     * Rendered HTML after content filters.
     */
    #[Required]
    public HTML $html;

    /**
     * Images after content filters. `[]` when none are found.
     */
    #[Required]
    public Images $images;

    /**
     * Object matching `jsonParams.schema`.
     */
    #[Required]
    public Json $json;

    /**
     * Markdown after content filters.
     */
    #[Required]
    public Markdown $markdown;

    /**
     * Page metadata. Fields are omitted when not found.
     */
    #[Required]
    public Metadata $metadata;

    /**
     * Custom rules return fields after content filters; unmatched fields are null ([] for lists). The google-maps parser returns business records in data.results, google-maps-reviews returns data.reviews, and the google-play parser returns one app record as data, google-play-reviews returns data.reviews, app-store and app-store-reviews do the same for the App Store, g2-reviews returns data.reviews for a G2 product, instagram-profile and instagram-post return one record as data, instagram-feed returns data.posts, tiktok-profile and tiktok-video return one record as data, tiktok-feed returns data.videos, tiktok-comments returns data.comments, tiktok-followers, tiktok-following, and tiktok-user-search return data.users, yelp-search returns up to 20 ranked organic businesses in data.businesses, plus total and pagination, from a Yelp search URL; yelp-reviews returns up to 20 latest public reviews in data.reviews, with business details and next_offset, from a Yelp business URL; emails, phone-numbers, and links return data.emails, data.phone_numbers, and data.links from the rendered page; the store, Maps, G2, Instagram, and TikTok parsers read their data directly, independently of DOM filters and other outputs.
     */
    #[Required]
    public Parsed $parsed;

    /**
     * Product details found on the page.
     */
    #[Required]
    public Product $product;

    /**
     * Authenticated browser profile used for this scrape, or null when no profile was requested. New and existing profile requests both return the profile ID.
     */
    #[Required]
    public ?Profile $profile;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Screenshot as a base64 image data URL.
     */
    #[Required]
    public Screenshot $screenshot;

    /**
     * Final URL after redirects and browser actions.
     */
    #[Required]
    public string $url;

    /**
     * True when at least one requested output succeeds but the response has failed or incomplete outputs. Absent when all requested outputs fail.
     */
    #[Optional]
    public ?bool $isPartial;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(
     *   bytes: ...,
     *   cacheMetadata: ...,
     *   highlights: ...,
     *   html: ...,
     *   images: ...,
     *   json: ...,
     *   markdown: ...,
     *   metadata: ...,
     *   parsed: ...,
     *   product: ...,
     *   profile: ...,
     *   requestID: ...,
     *   screenshot: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withBytes(...)
     *   ->withCacheMetadata(...)
     *   ->withHighlights(...)
     *   ->withHTML(...)
     *   ->withImages(...)
     *   ->withJson(...)
     *   ->withMarkdown(...)
     *   ->withMetadata(...)
     *   ->withParsed(...)
     *   ->withProduct(...)
     *   ->withProfile(...)
     *   ->withRequestID(...)
     *   ->withScreenshot(...)
     *   ->withURL(...)
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
     * @param Bytes|BytesShape $bytes
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     * @param Highlights|HighlightsShape $highlights
     * @param HTML|HTMLShape $html
     * @param Images|ImagesShape $images
     * @param Json|JsonShape $json
     * @param Markdown|MarkdownShape $markdown
     * @param Metadata|MetadataShape $metadata
     * @param Parsed|ParsedShape $parsed
     * @param Product|ProductShape $product
     * @param Profile|ProfileShape|null $profile
     * @param Screenshot|ScreenshotShape $screenshot
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        Bytes|array $bytes,
        CacheMetadata|array $cacheMetadata,
        Highlights|array $highlights,
        HTML|array $html,
        Images|array $images,
        Json|array $json,
        Markdown|array $markdown,
        Metadata|array $metadata,
        Parsed|array $parsed,
        Product|array $product,
        Profile|array|null $profile,
        string $requestID,
        Screenshot|array $screenshot,
        string $url,
        ?bool $isPartial = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['bytes'] = $bytes;
        $self['cacheMetadata'] = $cacheMetadata;
        $self['highlights'] = $highlights;
        $self['html'] = $html;
        $self['images'] = $images;
        $self['json'] = $json;
        $self['markdown'] = $markdown;
        $self['metadata'] = $metadata;
        $self['parsed'] = $parsed;
        $self['product'] = $product;
        $self['profile'] = $profile;
        $self['requestID'] = $requestID;
        $self['screenshot'] = $screenshot;
        $self['url'] = $url;

        null !== $isPartial && $self['isPartial'] = $isPartial;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * The original HTTP response body, unchanged by waits, actions, and filters.
     *
     * @param Bytes|BytesShape $bytes
     */
    public function withBytes(Bytes|array $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Whether this response came from cache.
     *
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     */
    public function withCacheMetadata(CacheMetadata|array $cacheMetadata): self
    {
        $self = clone $this;
        $self['cacheMetadata'] = $cacheMetadata;

        return $self;
    }

    /**
     * Relevant Markdown excerpts in page order. `[Heading]` adds context; `…` marks omitted text.
     *
     * @param Highlights|HighlightsShape $highlights
     */
    public function withHighlights(Highlights|array $highlights): self
    {
        $self = clone $this;
        $self['highlights'] = $highlights;

        return $self;
    }

    /**
     * Rendered HTML after content filters.
     *
     * @param HTML|HTMLShape $html
     */
    public function withHTML(HTML|array $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * Images after content filters. `[]` when none are found.
     *
     * @param Images|ImagesShape $images
     */
    public function withImages(Images|array $images): self
    {
        $self = clone $this;
        $self['images'] = $images;

        return $self;
    }

    /**
     * Object matching `jsonParams.schema`.
     *
     * @param Json|JsonShape $json
     */
    public function withJson(Json|array $json): self
    {
        $self = clone $this;
        $self['json'] = $json;

        return $self;
    }

    /**
     * Markdown after content filters.
     *
     * @param Markdown|MarkdownShape $markdown
     */
    public function withMarkdown(Markdown|array $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Page metadata. Fields are omitted when not found.
     *
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Custom rules return fields after content filters; unmatched fields are null ([] for lists). The google-maps parser returns business records in data.results, google-maps-reviews returns data.reviews, and the google-play parser returns one app record as data, google-play-reviews returns data.reviews, app-store and app-store-reviews do the same for the App Store, g2-reviews returns data.reviews for a G2 product, instagram-profile and instagram-post return one record as data, instagram-feed returns data.posts, tiktok-profile and tiktok-video return one record as data, tiktok-feed returns data.videos, tiktok-comments returns data.comments, tiktok-followers, tiktok-following, and tiktok-user-search return data.users, yelp-search returns up to 20 ranked organic businesses in data.businesses, plus total and pagination, from a Yelp search URL; yelp-reviews returns up to 20 latest public reviews in data.reviews, with business details and next_offset, from a Yelp business URL; emails, phone-numbers, and links return data.emails, data.phone_numbers, and data.links from the rendered page; the store, Maps, G2, Instagram, and TikTok parsers read their data directly, independently of DOM filters and other outputs.
     *
     * @param Parsed|ParsedShape $parsed
     */
    public function withParsed(Parsed|array $parsed): self
    {
        $self = clone $this;
        $self['parsed'] = $parsed;

        return $self;
    }

    /**
     * Product details found on the page.
     *
     * @param Product|ProductShape $product
     */
    public function withProduct(Product|array $product): self
    {
        $self = clone $this;
        $self['product'] = $product;

        return $self;
    }

    /**
     * Authenticated browser profile used for this scrape, or null when no profile was requested. New and existing profile requests both return the profile ID.
     *
     * @param Profile|ProfileShape|null $profile
     */
    public function withProfile(Profile|array|null $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Screenshot as a base64 image data URL.
     *
     * @param Screenshot|ScreenshotShape $screenshot
     */
    public function withScreenshot(Screenshot|array $screenshot): self
    {
        $self = clone $this;
        $self['screenshot'] = $screenshot;

        return $self;
    }

    /**
     * Final URL after redirects and browser actions.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * True when at least one requested output succeeds but the response has failed or incomplete outputs. Absent when all requested outputs fail.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $self = clone $this;
        $self['isPartial'] = $isPartial;

        return $self;
    }

    /**
     * Credits this request used and your remaining balance.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }
}
