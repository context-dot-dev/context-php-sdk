<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Relevant passages for your question or topic.
 *
 * @phpstan-type HighlightsShape = array{data: list<string>|null, requested: bool}
 */
final class Highlights implements BaseModel
{
    /** @use SdkModel<HighlightsShape> */
    use SdkModel;

    /** @var list<string>|null $data */
    #[Required(list: 'string')]
    public ?array $data;

    #[Required]
    public bool $requested;

    /**
     * `new Highlights()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Highlights::with(data: ..., requested: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Highlights)->withData(...)->withRequested(...)
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
     * @param list<string>|null $data
     */
    public static function with(?array $data, bool $requested): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['requested'] = $requested;

        return $self;
    }

    /**
     * @param list<string>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withRequested(bool $requested): self
    {
        $self = clone $this;
        $self['requested'] = $requested;

        return $self;
    }
}
