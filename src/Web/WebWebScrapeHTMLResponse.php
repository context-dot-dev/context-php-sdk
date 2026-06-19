<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeHTMLResponse\KeyMetadata;
use ContextDev\Web\WebWebScrapeHTMLResponse\Metadata;
use ContextDev\Web\WebWebScrapeHTMLResponse\Type;

/**
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebWebScrapeHTMLResponse\Metadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeHTMLResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeHTMLResponseShape = array{
 *   html: string,
 *   metadata: Metadata|MetadataShape,
 *   success: bool,
 *   type: Type|value-of<Type>,
 *   url: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeHTMLResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeHTMLResponseShape> */
    use SdkModel;

    /**
     * The scraped content of the page. For normal pages this is the raw HTML. When the page is a sitemap or feed served behind an XSL stylesheet (which browsers render into HTML), this is the underlying XML instead — see the `type` field.
     */
    #[Required]
    public string $html;

    /**
     * Metadata extracted from the scraped page HTML.
     */
    #[Required]
    public Metadata $metadata;

    /**
     * Indicates success.
     */
    #[Required]
    public bool $success;

    /**
     * Detected content type of the returned `html` field. Sitemaps and feeds are surfaced as `xml`; ordinary pages are `html`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The URL that was scraped.
     */
    #[Required]
    public string $url;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeHTMLResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeHTMLResponse::with(
     *   html: ..., metadata: ..., success: ..., type: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeHTMLResponse)
     *   ->withHTML(...)
     *   ->withMetadata(...)
     *   ->withSuccess(...)
     *   ->withType(...)
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
     * @param Metadata|MetadataShape $metadata
     * @param Type|value-of<Type> $type
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $html,
        Metadata|array $metadata,
        bool $success,
        Type|string $type,
        string $url,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['html'] = $html;
        $self['metadata'] = $metadata;
        $self['success'] = $success;
        $self['type'] = $type;
        $self['url'] = $url;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * The scraped content of the page. For normal pages this is the raw HTML. When the page is a sitemap or feed served behind an XSL stylesheet (which browsers render into HTML), this is the underlying XML instead — see the `type` field.
     */
    public function withHTML(string $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * Metadata extracted from the scraped page HTML.
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
     * Indicates success.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Detected content type of the returned `html` field. Sitemaps and feeds are surfaced as `xml`; ordinary pages are `html`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The URL that was scraped.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
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
