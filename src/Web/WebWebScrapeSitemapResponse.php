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
 *   requestID: string,
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
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Indicates success.
     */
    #[Required]
    public bool $success;

    /**
     * Discovered page URLs from the sitemap, up to `maxLinks`. When `search` is set these are only the matching pages, most relevant first.
     *
     * @var list<string> $urls
     */
    #[Required(list: 'string')]
    public array $urls;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeSitemapResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeSitemapResponse::with(
     *   domain: ..., meta: ..., requestID: ..., success: ..., urls: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeSitemapResponse)
     *   ->withDomain(...)
     *   ->withMeta(...)
     *   ->withRequestID(...)
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
        string $requestID,
        bool $success,
        array $urls,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['meta'] = $meta;
        $self['requestID'] = $requestID;
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
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

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
     * Discovered page URLs from the sitemap, up to `maxLinks`. When `search` is set these are only the matching pages, most relevant first.
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
