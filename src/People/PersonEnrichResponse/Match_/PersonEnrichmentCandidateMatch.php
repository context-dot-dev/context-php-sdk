<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

/**
 * The best-matching person, with an identity-match score.
 *
 * @phpstan-import-type PersonShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person
 *
 * @phpstan-type PersonEnrichmentCandidateMatchShape = array{
 *   person: Person|PersonShape, score: int, status: 'candidate'
 * }
 */
final class PersonEnrichmentCandidateMatch implements BaseModel
{
    /** @use SdkModel<PersonEnrichmentCandidateMatchShape> */
    use SdkModel;

    /**
     * Always `candidate` for a match.
     *
     * @var 'candidate' $status
     */
    #[Required]
    public string $status = 'candidate';

    /**
     * Profile of the matched person.
     */
    #[Required]
    public Person $person;

    /**
     * Identity-match score from 0 to 100. Higher is a stronger match; weak candidates are still returned.
     */
    #[Required]
    public int $score;

    /**
     * `new PersonEnrichmentCandidateMatch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PersonEnrichmentCandidateMatch::with(person: ..., score: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PersonEnrichmentCandidateMatch)->withPerson(...)->withScore(...)
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
     * @param Person|PersonShape $person
     */
    public static function with(Person|array $person, int $score): self
    {
        $self = new self;

        $self['person'] = $person;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Profile of the matched person.
     *
     * @param Person|PersonShape $person
     */
    public function withPerson(Person|array $person): self
    {
        $self = clone $this;
        $self['person'] = $person;

        return $self;
    }

    /**
     * Identity-match score from 0 to 100. Higher is a stronger match; weak candidates are still returned.
     */
    public function withScore(int $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Always `candidate` for a match.
     *
     * @param 'candidate' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
