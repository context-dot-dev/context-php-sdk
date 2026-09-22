<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebMapURLsResponse\KeyMetadata;
use ContextDev\Web\WebMapURLsResponse\URL;

/**
 * @phpstan-import-type URLShape from \ContextDev\Web\WebMapURLsResponse\URL
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebMapURLsResponse\KeyMetadata
 *
 * @phpstan-type WebMapURLsResponseShape = array{
 *   domain: string,
 *   requestID: string,
 *   success: bool,
 *   urls: list<URL|URLShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 * }
 */
final class WebMapURLsResponse implements BaseModel
{
    /** @use SdkModel<WebMapURLsResponseShape> */
    use SdkModel;

    #[Required]
    public string $domain;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    #[Required]
    public bool $success;

    /** @var list<URL> $urls */
    #[Required(list: URL::class)]
    public array $urls;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    #[Optional]
    public ?bool $partial;

    /**
     * `new WebMapURLsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebMapURLsResponse::with(domain: ..., requestID: ..., success: ..., urls: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebMapURLsResponse)
     *   ->withDomain(...)
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
     * @param list<URL|URLShape> $urls
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $domain,
        string $requestID,
        bool $success,
        array $urls,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['requestID'] = $requestID;
        $self['success'] = $success;
        $self['urls'] = $urls;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;

        return $self;
    }

    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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

    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param list<URL|URLShape> $urls
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

    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
