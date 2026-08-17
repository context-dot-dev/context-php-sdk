<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchResponse\Data\Match_\Level;

/**
 * How the article relates to the company you searched for.
 *
 * @phpstan-type MatchShape = array{
 *   confidence: float|null, level: Level|value-of<Level>
 * }
 */
final class Match_ implements BaseModel
{
    /** @use SdkModel<MatchShape> */
    use SdkModel;

    /**
     * How confident the match is, from 0 to 1. Null when a score is unavailable.
     */
    #[Required]
    public ?float $confidence;

    /**
     * primary when the article is mainly about the company, secondary when the company is mentioned but is not the main subject.
     *
     * @var value-of<Level> $level
     */
    #[Required(enum: Level::class)]
    public string $level;

    /**
     * `new Match_()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Match_::with(confidence: ..., level: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Match_)->withConfidence(...)->withLevel(...)
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
     * @param Level|value-of<Level> $level
     */
    public static function with(?float $confidence, Level|string $level): self
    {
        $self = new self;

        $self['confidence'] = $confidence;
        $self['level'] = $level;

        return $self;
    }

    /**
     * How confident the match is, from 0 to 1. Null when a score is unavailable.
     */
    public function withConfidence(?float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * primary when the article is mainly about the company, secondary when the company is mentioned but is not the main subject.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }
}
