<?php

declare(strict_types=1);

namespace ContextDev\Utility;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Utility\UtilityPrefetchResponse\KeyMetadata;
use ContextDev\Utility\UtilityPrefetchResponse\Type;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Utility\UtilityPrefetchResponse\KeyMetadata
 *
 * @phpstan-type UtilityPrefetchResponseShape = array{
 *   requestID: string,
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   message?: string|null,
 *   status?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class UtilityPrefetchResponse implements BaseModel
{
    /** @use SdkModel<UtilityPrefetchResponseShape> */
    use SdkModel;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * The domain that was queued for prefetching.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Success message.
     */
    #[Optional]
    public ?string $message;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Optional]
    public ?string $status;

    /**
     * The type of prefetch that was queued, echoed from the request.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new UtilityPrefetchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UtilityPrefetchResponse::with(requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UtilityPrefetchResponse)->withRequestID(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $requestID,
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $message = null,
        ?string $status = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['requestID'] = $requestID;

        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $message && $self['message'] = $message;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

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
     * The domain that was queued for prefetching.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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

    /**
     * Success message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Status of the response, e.g., 'ok'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The type of prefetch that was queued, echoed from the request.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
