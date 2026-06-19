<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchResponse\Result\Markdown\Code;

/**
 * Markdown scrape status and content for this result.
 *
 * @phpstan-type MarkdownShape = array{
 *   code: Code|value-of<Code>, markdown: string|null
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
     */
    public static function with(Code|string $code, ?string $markdown): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['markdown'] = $markdown;

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
}
