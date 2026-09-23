<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Bytes;
use ContextDev\Web\WebScrapeResponse\CacheMetadata;
use ContextDev\Web\WebScrapeResponse\Highlights;
use ContextDev\Web\WebScrapeResponse\HTML;
use ContextDev\Web\WebScrapeResponse\Images;
use ContextDev\Web\WebScrapeResponse\Json;
use ContextDev\Web\WebScrapeResponse\KeyMetadata;
use ContextDev\Web\WebScrapeResponse\Markdown;
use ContextDev\Web\WebScrapeResponse\Metadata;
use ContextDev\Web\WebScrapeResponse\Parsed;
use ContextDev\Web\WebScrapeResponse\Product;
use ContextDev\Web\WebScrapeResponse\Screenshot;

/**
 * @phpstan-import-type BytesShape from \ContextDev\Web\WebScrapeResponse\Bytes
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebScrapeResponse\CacheMetadata
 * @phpstan-import-type HighlightsShape from \ContextDev\Web\WebScrapeResponse\Highlights
 * @phpstan-import-type HTMLShape from \ContextDev\Web\WebScrapeResponse\HTML
 * @phpstan-import-type ImagesShape from \ContextDev\Web\WebScrapeResponse\Images
 * @phpstan-import-type JsonShape from \ContextDev\Web\WebScrapeResponse\Json
 * @phpstan-import-type MarkdownShape from \ContextDev\Web\WebScrapeResponse\Markdown
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebScrapeResponse\Metadata
 * @phpstan-import-type ParsedShape from \ContextDev\Web\WebScrapeResponse\Parsed
 * @phpstan-import-type ProductShape from \ContextDev\Web\WebScrapeResponse\Product
 * @phpstan-import-type ScreenshotShape from \ContextDev\Web\WebScrapeResponse\Screenshot
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebScrapeResponse\KeyMetadata
 *
 * @phpstan-type WebScrapeResponseShape = array{
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
 *   requestID: string,
 *   screenshot: Screenshot|ScreenshotShape,
 *   url: string,
 *   isPartial?: bool|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebScrapeResponse implements BaseModel
{
    /** @use SdkModel<WebScrapeResponseShape> */
    use SdkModel;

    /**
     * Original HTTP response body. Waiting, actions, and content filters never change it.
     */
    #[Required]
    public Bytes $bytes;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Relevant passages for your question or topic.
     */
    #[Required]
    public Highlights $highlights;

    /**
     * Rendered HTML after content filters.
     */
    #[Required]
    public HTML $html;

    /**
     * Images after content filters. Empty when none are found.
     */
    #[Required]
    public Images $images;

    /**
     * Page data extracted using your schema.
     */
    #[Required]
    public Json $json;

    /**
     * Markdown after content filters.
     */
    #[Required]
    public Markdown $markdown;

    /**
     * Page details, when available.
     */
    #[Required]
    public Metadata $metadata;

    /**
     * Fields produced by parseParams.rules, after shared content filters.
     */
    #[Required]
    public Parsed $parsed;

    /**
     * Product details found on the page.
     */
    #[Required]
    public Product $product;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * An image data URL. Use directly as an image src.
     */
    #[Required]
    public Screenshot $screenshot;

    /**
     * Final URL after redirects and browser actions.
     */
    #[Required]
    public string $url;

    /**
     * Present when return-partial captures a page that is still loading, returns images before image processing finishes, or cuts product AI extraction short. Also present if the optional product AI fallback fails. Partial responses are not cached.
     */
    #[Optional]
    public ?bool $isPartial;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebScrapeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebScrapeResponse::with(
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
     *   requestID: ...,
     *   screenshot: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebScrapeResponse)
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
        $self['requestID'] = $requestID;
        $self['screenshot'] = $screenshot;
        $self['url'] = $url;

        null !== $isPartial && $self['isPartial'] = $isPartial;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Original HTTP response body. Waiting, actions, and content filters never change it.
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
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
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
     * Relevant passages for your question or topic.
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
     * Images after content filters. Empty when none are found.
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
     * Page data extracted using your schema.
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
     * Page details, when available.
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
     * Fields produced by parseParams.rules, after shared content filters.
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
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * An image data URL. Use directly as an image src.
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
     * Present when return-partial captures a page that is still loading, returns images before image processing finishes, or cuts product AI extraction short. Also present if the optional product AI fallback fails. Partial responses are not cached.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $self = clone $this;
        $self['isPartial'] = $isPartial;

        return $self;
    }

    /**
     * Credit usage, included whenever a valid API key is provided.
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
