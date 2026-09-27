<?php

declare(strict_types=1);

namespace ContextDev\Industry;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Industry\IndustryGetNaicsResponse\Code;
use ContextDev\Industry\IndustryGetNaicsResponse\KeyMetadata;

/**
 * @phpstan-import-type CodeShape from \ContextDev\Industry\IndustryGetNaicsResponse\Code
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Industry\IndustryGetNaicsResponse\KeyMetadata
 *
 * @phpstan-type IndustryGetNaicsResponseShape = array{
 *   requestID: string,
 *   codes?: list<Code|CodeShape>|null,
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 *   status?: string|null,
 *   type?: string|null,
 * }
 */
final class IndustryGetNaicsResponse implements BaseModel
{
    /** @use SdkModel<IndustryGetNaicsResponseShape> */
    use SdkModel;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

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
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * True when the timeout ended processing and this response contains only usable results completed so far. Unfinished results are omitted.
     */
    #[Optional]
    public ?bool $partial;

    /**
     * Always `ok` on success.
     */
    #[Optional]
    public ?string $status;

    /**
     * Industry classification type, for naics api it will be `naics`.
     */
    #[Optional]
    public ?string $type;

    /**
     * `new IndustryGetNaicsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IndustryGetNaicsResponse::with(requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IndustryGetNaicsResponse)->withRequestID(...)
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
     * @param list<Code|CodeShape>|null $codes
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $requestID,
        ?array $codes = null,
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
        ?string $status = null,
        ?string $type = null,
    ): self {
        $self = new self;

        $self['requestID'] = $requestID;

        null !== $codes && $self['codes'] = $codes;
        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

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
     * True when the timeout ended processing and this response contains only usable results completed so far. Unfinished results are omitted.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }

    /**
     * Always `ok` on success.
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
