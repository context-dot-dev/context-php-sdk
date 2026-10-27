<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchResponse\Result;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * How well the person matches the query. Only returned in `ultra` mode.
 *
 * @phpstan-type MatchShape = array{confidence: float}
 */
final class Match_ implements BaseModel
{
    /** @use SdkModel<MatchShape> */
    use SdkModel;

    /**
     * How well the person matches the query, from 0 to 1.
     */
    #[Required]
    public float $confidence;

    /**
     * `new Match_()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Match_::with(confidence: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Match_)->withConfidence(...)
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
     */
    public static function with(float $confidence): self
    {
        $self = new self;

        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * How well the person matches the query, from 0 to 1.
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }
}
