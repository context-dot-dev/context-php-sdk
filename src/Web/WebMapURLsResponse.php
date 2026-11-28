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

    /**
     * Normalized domain that was mapped.
     */
    #[Required]
    public string $domain;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Always `true` on success.
     */
    #[Required]
    public bool $success;

    /**
     * URLs found on the domain, with page metadata when available.
     *
     * @var list<URL> $urls
     */
    #[Required(list: URL::class)]
    public array $urls;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `true` when the deadline passed with `timeoutOpts.behavior` set to `return-partial`. Only results finished in time are included.
     */
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

    /**
     * Normalized domain that was mapped.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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
     * Always `true` on success.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * URLs found on the domain, with page metadata when available.
     *
     * @param list<URL|URLShape> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

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

    /**
     * `true` when the deadline passed with `timeoutOpts.behavior` set to `return-partial`. Only results finished in time are included.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
