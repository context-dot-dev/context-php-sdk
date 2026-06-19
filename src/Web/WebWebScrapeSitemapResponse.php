<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeSitemapResponse\KeyMetadata;
use ContextDev\Web\WebWebScrapeSitemapResponse\Meta;

/**
 * @phpstan-import-type MetaShape from \ContextDev\Web\WebWebScrapeSitemapResponse\Meta
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeSitemapResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeSitemapResponseShape = array{
 *   domain: string,
 *   meta: Meta|MetaShape,
 *   success: bool,
 *   urls: list<string>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeSitemapResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeSitemapResponseShape> */
    use SdkModel;

    /**
     * The normalized domain that was crawled.
     */
    #[Required]
    public string $domain;

    /**
     * Metadata about the sitemap crawl operation.
     */
    #[Required]
    public Meta $meta;

    /**
     * Indicates success.
     */
    #[Required]
    public bool $success;

    /**
     * Array of discovered page URLs from the sitemap (max 500).
     *
     * @var list<string> $urls
     */
    #[Required(list: 'string')]
    public array $urls;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeSitemapResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeSitemapResponse::with(
     *   domain: ..., meta: ..., success: ..., urls: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeSitemapResponse)
     *   ->withDomain(...)
     *   ->withMeta(...)
     *   ->withSuccess(...)
     *   ->withURLs(...)
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
     * @param Meta|MetaShape $meta
     * @param list<string> $urls
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $domain,
        Meta|array $meta,
        bool $success,
        array $urls,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['meta'] = $meta;
        $self['success'] = $success;
        $self['urls'] = $urls;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * The normalized domain that was crawled.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Metadata about the sitemap crawl operation.
     *
     * @param Meta|MetaShape $meta
     */
    public function withMeta(Meta|array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

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
     * Array of discovered page URLs from the sitemap (max 500).
     *
     * @param list<string> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

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
