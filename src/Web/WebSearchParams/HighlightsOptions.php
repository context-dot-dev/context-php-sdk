<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Passages from each result page that are relevant to the query. Pages are read with the `markdownOptions` settings.
 *
 * @phpstan-type HighlightsOptionsShape = array{
 *   enabled?: bool|null, maxCharacters?: int|null
 * }
 */
final class HighlightsOptions implements BaseModel
{
    /** @use SdkModel<HighlightsOptionsShape> */
    use SdkModel;

    /**
     * Return relevant passages for each result. Adds 1 credit per 10 results.
     */
    #[Optional]
    public ?bool $enabled;

    /**
     * Maximum combined length of passages per result.
     */
    #[Optional]
    public ?int $maxCharacters;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $enabled = null,
        ?int $maxCharacters = null
    ): self {
        $self = new self;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $maxCharacters && $self['maxCharacters'] = $maxCharacters;

        return $self;
    }

    /**
     * Return relevant passages for each result. Adds 1 credit per 10 results.
     */
    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Maximum combined length of passages per result.
     */
    public function withMaxCharacters(int $maxCharacters): self
    {
        $self = clone $this;
        $self['maxCharacters'] = $maxCharacters;

        return $self;
    }
}
