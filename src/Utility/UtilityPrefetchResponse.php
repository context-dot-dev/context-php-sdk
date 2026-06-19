<?php

declare(strict_types=1);

namespace ContextDev\Utility;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Utility\UtilityPrefetchResponse\KeyMetadata;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Utility\UtilityPrefetchResponse\KeyMetadata
 *
 * @phpstan-type UtilityPrefetchResponseShape = array{
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   message?: string|null,
 *   status?: string|null,
 * }
 */
final class UtilityPrefetchResponse implements BaseModel
{
    /** @use SdkModel<UtilityPrefetchResponseShape> */
    use SdkModel;

    /**
     * The domain that was queued for prefetching.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
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
     */
    public static function with(
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $message = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $message && $self['message'] = $message;
        null !== $status && $self['status'] = $status;

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
}
