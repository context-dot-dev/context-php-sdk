<?php

declare(strict_types=1);

namespace ContextDev\Industry;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryGetNaicsResponse\Code;
use ContextDev\Industry\IndustryGetNaicsResponse\KeyMetadata;

/**
 * @phpstan-import-type CodeShape from \ContextDev\Industry\IndustryGetNaicsResponse\Code
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Industry\IndustryGetNaicsResponse\KeyMetadata
 *
 * @phpstan-type IndustryGetNaicsResponseShape = array{
 *   codes?: list<Code|CodeShape>|null,
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   status?: string|null,
 *   type?: string|null,
 * }
 */
final class IndustryGetNaicsResponse implements BaseModel
{
    /** @use SdkModel<IndustryGetNaicsResponseShape> */
    use SdkModel;

    /**
     * Array of NAICS codes and titles.
     *
     * @var list<Code>|null $codes
     */
    #[Optional(list: Code::class)]
    public ?array $codes;

    /**
     * Domain found for the brand.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Optional]
    public ?string $status;

    /**
     * Industry classification type, for naics api it will be `naics`.
     */
    #[Optional]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Code|CodeShape>|null $codes
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        ?array $codes = null,
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $status = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $codes && $self['codes'] = $codes;
        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Array of NAICS codes and titles.
     *
     * @param list<Code|CodeShape> $codes
     */
    public function withCodes(array $codes): self
    {
        $self = clone $this;
        $self['codes'] = $codes;

        return $self;
    }

    /**
     * Domain found for the brand.
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
     * Status of the response, e.g., 'ok'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Industry classification type, for naics api it will be `naics`.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
