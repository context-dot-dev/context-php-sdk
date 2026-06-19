<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchResponse\Result\Markdown;
use ContextDev\Web\WebSearchResponse\Result\Relevance;

/**
 * @phpstan-import-type MarkdownShape from \ContextDev\Web\WebSearchResponse\Result\Markdown
 *
 * @phpstan-type ResultShape = array{
 *   description: string,
 *   markdown: Markdown|MarkdownShape,
 *   relevance: Relevance|value-of<Relevance>,
 *   title: string,
 *   url: string,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Snippet excerpt from the page.
     */
    #[Required]
    public string $description;

    /**
     * Markdown scrape status and content for this result.
     */
    #[Required]
    public Markdown $markdown;

    /**
     * Relevance to the original query.
     *
     * @var value-of<Relevance> $relevance
     */
    #[Required(enum: Relevance::class)]
    public string $relevance;

    /**
     * Page title.
     */
    #[Required]
    public string $title;

    /**
     * Canonical result URL.
     */
    #[Required]
    public string $url;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(
     *   description: ..., markdown: ..., relevance: ..., title: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withDescription(...)
     *   ->withMarkdown(...)
     *   ->withRelevance(...)
     *   ->withTitle(...)
     *   ->withURL(...)
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
     * @param Markdown|MarkdownShape $markdown
     * @param Relevance|value-of<Relevance> $relevance
     */
    public static function with(
        string $description,
        Markdown|array $markdown,
        Relevance|string $relevance,
        string $title,
        string $url,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['markdown'] = $markdown;
        $self['relevance'] = $relevance;
        $self['title'] = $title;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Snippet excerpt from the page.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Markdown scrape status and content for this result.
     *
     * @param Markdown|MarkdownShape $markdown
     */
    public function withMarkdown(Markdown|array $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Relevance to the original query.
     *
     * @param Relevance|value-of<Relevance> $relevance
     */
    public function withRelevance(Relevance|string $relevance): self
    {
        $self = clone $this;
        $self['relevance'] = $relevance;

        return $self;
    }

    /**
     * Page title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Canonical result URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
