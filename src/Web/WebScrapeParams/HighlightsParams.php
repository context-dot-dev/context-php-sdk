<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Highlight options. Requires formats.highlights: true.
 *
 * @phpstan-type HighlightsParamsShape = array{
 *   query: string, maxCharacters?: int|null
 * }
 */
final class HighlightsParams implements BaseModel
{
    /** @use SdkModel<HighlightsParamsShape> */
    use SdkModel;

    /**
     * The question or topic to find passages for.
     */
    #[Required]
    public string $query;

    /**
     * Maximum combined length of the returned passages, in characters.
     */
    #[Optional]
    public ?int $maxCharacters;

    /**
     * `new HighlightsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * HighlightsParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new HighlightsParams)->withQuery(...)
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
    public static function with(string $query, ?int $maxCharacters = null): self
    {
        $self = new self;

        $self['query'] = $query;

        null !== $maxCharacters && $self['maxCharacters'] = $maxCharacters;

        return $self;
    }

    /**
     * The question or topic to find passages for.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Maximum combined length of the returned passages, in characters.
     */
    public function withMaxCharacters(int $maxCharacters): self
    {
        $self = clone $this;
        $self['maxCharacters'] = $maxCharacters;

        return $self;
    }
}
