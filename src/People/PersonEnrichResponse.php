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
 *   match: MatchShape, keyMetadata?: null|KeyMetadata|KeyMetadataShape
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
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new PersonEnrichResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PersonEnrichResponse::with(match: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PersonEnrichResponse)->withMatch(...)
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
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['match'] = $match;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
