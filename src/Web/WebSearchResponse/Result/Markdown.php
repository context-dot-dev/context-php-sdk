<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchResponse\Result\Markdown\Code;
use ContextDev\Web\WebSearchResponse\Result\Markdown\FinalDomState;

/**
 * Markdown scrape status and content for this result.
 *
 * @phpstan-type MarkdownShape = array{
 *   code: Code|value-of<Code>,
 *   markdown: string|null,
 *   finalDomState?: null|FinalDomState|value-of<FinalDomState>,
 * }
 */
final class Markdown implements BaseModel
{
    /** @use SdkModel<MarkdownShape> */
    use SdkModel;

    /**
     * Per-result scrape outcome. Inspect this before reading `markdown`.
     *
     * @var value-of<Code> $code
     */
    #[Required(enum: Code::class)]
    public string $code;

    /**
     * GFM Markdown of the page. Null unless markdownOptions.enabled is true and scraping succeeded.
     */
    #[Required]
    public ?string $markdown;

    /**
     * How complete the returned content is. `loaded` means the page finished the waits the request asked for. `still-loading` only occurs with timeoutOpts.behavior=return-partial: the timeoutOpts.milliseconds deadline was reached first, so the content reflects the DOM at that moment and late-rendering parts may be missing. Partial results are billed at the base request cost.
     *
     * @var value-of<FinalDomState>|null $finalDomState
     */
    #[Optional('finalDOMState', enum: FinalDomState::class)]
    public ?string $finalDomState;

    /**
     * `new Markdown()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Markdown::with(code: ..., markdown: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Markdown)->withCode(...)->withMarkdown(...)
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
     * @param FinalDomState|value-of<FinalDomState>|null $finalDomState
     */
    public static function with(
        Code|string $code,
        ?string $markdown,
        FinalDomState|string|null $finalDomState = null,
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['markdown'] = $markdown;

        null !== $finalDomState && $self['finalDomState'] = $finalDomState;

        return $self;
    }

    /**
     * Per-result scrape outcome. Inspect this before reading `markdown`.
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
     * GFM Markdown of the page. Null unless markdownOptions.enabled is true and scraping succeeded.
     */
    public function withMarkdown(?string $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * How complete the returned content is. `loaded` means the page finished the waits the request asked for. `still-loading` only occurs with timeoutOpts.behavior=return-partial: the timeoutOpts.milliseconds deadline was reached first, so the content reflects the DOM at that moment and late-rendering parts may be missing. Partial results are billed at the base request cost.
     *
     * @param FinalDomState|value-of<FinalDomState> $finalDomState
     */
    public function withFinalDomState(FinalDomState|string $finalDomState): self
    {
        $self = clone $this;
        $self['finalDomState'] = $finalDomState;

        return $self;
    }
}
