<?php

declare(strict_types=1);

namespace ContextDev\People;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichResponse\KeyMetadata;
use ContextDev\People\PersonEnrichResponse\Match_;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentNotFoundMatch;

/**
 * @phpstan-import-type MatchVariants from \ContextDev\People\PersonEnrichResponse\Match_
 * @phpstan-import-type MatchShape from \ContextDev\People\PersonEnrichResponse\Match_
 * @phpstan-import-type KeyMetadataShape from \ContextDev\People\PersonEnrichResponse\KeyMetadata
 *
 * @phpstan-type PersonEnrichResponseShape = array{
 *   match: MatchShape,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 * }
 */
final class PersonEnrichResponse implements BaseModel
{
    /** @use SdkModel<PersonEnrichResponseShape> */
    use SdkModel;

    /**
     * The highest-scoring person candidate.
     *
     * @var MatchVariants $match
     */
    #[Required(union: Match_::class)]
    public PersonEnrichmentCandidateMatch|PersonEnrichmentNotFoundMatch $match;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * True when the timeout ended processing and this response contains the usable data completed so far. Unfinished fields are omitted.
     */
    #[Optional]
    public ?bool $partial;

    /**
     * `new PersonEnrichResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PersonEnrichResponse::with(match: ..., requestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PersonEnrichResponse)->withMatch(...)->withRequestID(...)
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
     * @param MatchShape $match
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        PersonEnrichmentCandidateMatch|array|PersonEnrichmentNotFoundMatch $match,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['match'] = $match;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;

        return $self;
    }

    /**
     * The highest-scoring person candidate.
     *
     * @param MatchShape $match
     */
    public function withMatch(
        PersonEnrichmentCandidateMatch|array|PersonEnrichmentNotFoundMatch $match
    ): self {
        $self = clone $this;
        $self['match'] = $match;

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
     * True when the timeout ended processing and this response contains the usable data completed so far. Unfinished fields are omitted.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
