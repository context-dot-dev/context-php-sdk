<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Scholar\ScholarSearchResponse\Data\FullTextFormat;

/**
 * @phpstan-type DataShape = array{
 *   id: string,
 *   fullTextFormat: FullTextFormat|value-of<FullTextFormat>,
 *   fullTextURL: string,
 *   publishedAt: \DateTimeInterface|null,
 *   snippet: string,
 *   title: string,
 *   url: string,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique ID of the paper.
     */
    #[Required]
    public string $id;

    /**
     * Format of the full text at `full_text_url`. `jats` is JATS XML.
     *
     * @var value-of<FullTextFormat> $fullTextFormat
     */
    #[Required('full_text_format', enum: FullTextFormat::class)]
    public string $fullTextFormat;

    /**
     * Direct URL of the full text.
     */
    #[Required('full_text_url')]
    public string $fullTextURL;

    /**
     * When the paper was published. `null` when unknown.
     */
    #[Required('published_at')]
    public ?\DateTimeInterface $publishedAt;

    /**
     * Passage that matches the query, or the opening passage when the query is only a paper ID.
     */
    #[Required]
    public string $snippet;

    /**
     * Title of the paper.
     */
    #[Required]
    public string $title;

    /**
     * URL of the paper's landing page.
     */
    #[Required]
    public string $url;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   fullTextFormat: ...,
     *   fullTextURL: ...,
     *   publishedAt: ...,
     *   snippet: ...,
     *   title: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withID(...)
     *   ->withFullTextFormat(...)
     *   ->withFullTextURL(...)
     *   ->withPublishedAt(...)
     *   ->withSnippet(...)
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
     * @param FullTextFormat|value-of<FullTextFormat> $fullTextFormat
     */
    public static function with(
        string $id,
        FullTextFormat|string $fullTextFormat,
        string $fullTextURL,
        ?\DateTimeInterface $publishedAt,
        string $snippet,
        string $title,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['fullTextFormat'] = $fullTextFormat;
        $self['fullTextURL'] = $fullTextURL;
        $self['publishedAt'] = $publishedAt;
        $self['snippet'] = $snippet;
        $self['title'] = $title;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Unique ID of the paper.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Format of the full text at `full_text_url`. `jats` is JATS XML.
     *
     * @param FullTextFormat|value-of<FullTextFormat> $fullTextFormat
     */
    public function withFullTextFormat(
        FullTextFormat|string $fullTextFormat
    ): self {
        $self = clone $this;
        $self['fullTextFormat'] = $fullTextFormat;

        return $self;
    }

    /**
     * Direct URL of the full text.
     */
    public function withFullTextURL(string $fullTextURL): self
    {
        $self = clone $this;
        $self['fullTextURL'] = $fullTextURL;

        return $self;
    }

    /**
     * When the paper was published. `null` when unknown.
     */
    public function withPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * Passage that matches the query, or the opening passage when the query is only a paper ID.
     */
    public function withSnippet(string $snippet): self
    {
        $self = clone $this;
        $self['snippet'] = $snippet;

        return $self;
    }

    /**
     * Title of the paper.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * URL of the paper's landing page.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
