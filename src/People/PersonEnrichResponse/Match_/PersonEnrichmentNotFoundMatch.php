<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * No usable person candidate was found.
 *
 * @phpstan-type PersonEnrichmentNotFoundMatchShape = array{
 *   person: null|null, score: null|null, status: 'not_found'
 * }
 */
final class PersonEnrichmentNotFoundMatch implements BaseModel
{
    /** @use SdkModel<PersonEnrichmentNotFoundMatchShape> */
    use SdkModel;

    /** @var 'not_found' $status */
    #[Required]
    public string $status = 'not_found';

    /** @var null|null $person */
    #[Required]
    public null $person;

    /** @var null|null $score */
    #[Required]
    public null $score;

    /**
     * `new PersonEnrichmentNotFoundMatch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PersonEnrichmentNotFoundMatch::with(person: ..., score: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PersonEnrichmentNotFoundMatch)->withPerson(...)->withScore(...)
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
     * @param null|null $person
     * @param null|null $score
     */
    public static function with(null $person, null $score): self
    {
        $self = new self;

        $self['person'] = $person;
        $self['score'] = $score;

        return $self;
    }

    /**
     * @param null|null $person
     */
    public function withPerson(null $person): self
    {
        $self = clone $this;
        $self['person'] = $person;

        return $self;
    }

    /**
     * @param null|null $score
     */
    public function withScore(null $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * @param 'not_found' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
