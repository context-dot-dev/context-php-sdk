<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Relevant passages for your question or topic, in page order. A heading in square brackets is included when needed to interpret a passage. Empty when the page has no text.
 *
 * @phpstan-type HighlightsShape = array{
 *   data: list<string>|null, requested: bool, success: bool|null
 * }
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
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    #[Required]
    public ?bool $success;

    /**
     * `new Highlights()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Highlights::with(data: ..., requested: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Highlights)->withData(...)->withRequested(...)->withSuccess(...)
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
    public static function with(
        ?array $data,
        bool $requested,
        ?bool $success
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requested'] = $requested;
        $self['success'] = $success;

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

    /**
     * True when retrieved, false when retrieval failed, and null when not requested.
     */
    public function withSuccess(?bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
