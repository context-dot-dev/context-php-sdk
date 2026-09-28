<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchResponse\Result\Highlights\Code;

/**
 * Highlights status and passages for this result.
 *
 * @phpstan-type HighlightsShape = array{
 *   code: Code|value-of<Code>, highlights: list<string>|null
 * }
 */
final class Highlights implements BaseModel
{
    /** @use SdkModel<HighlightsShape> */
    use SdkModel;

    /**
     * Per-result highlights outcome. Inspect this before reading `highlights`.
     *
     * @var value-of<Code> $code
     */
    #[Required(enum: Code::class)]
    public string $code;

    /**
     * Passages relevant to the query, in page order. Null unless highlightsOptions.enabled is true and the page was read.
     *
     * @var list<string>|null $highlights
     */
    #[Required(list: 'string')]
    public ?array $highlights;

    /**
     * `new Highlights()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Highlights::with(code: ..., highlights: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Highlights)->withCode(...)->withHighlights(...)
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
     * @param Code|value-of<Code> $code
     * @param list<string>|null $highlights
     */
    public static function with(Code|string $code, ?array $highlights): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['highlights'] = $highlights;

        return $self;
    }

    /**
     * Per-result highlights outcome. Inspect this before reading `highlights`.
     *
     * @param Code|value-of<Code> $code
     */
    public function withCode(Code|string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Passages relevant to the query, in page order. Null unless highlightsOptions.enabled is true and the page was read.
     *
     * @param list<string>|null $highlights
     */
    public function withHighlights(?array $highlights): self
    {
        $self = clone $this;
        $self['highlights'] = $highlights;

        return $self;
    }
}
