<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Options;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Source;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Source\Sitemap;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Source\StartURL;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Crawl pages and return Markdown.
 *
 * @phpstan-import-type SourceVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Source
 * @phpstan-import-type SourceShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Source
 * @phpstan-import-type OptionsShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Options
 *
 * @phpstan-type MarkdownShape = array{
 *   format: 'markdown', source: SourceShape, options?: null|Options|OptionsShape
 * }
 */
final class Markdown implements BaseModel
{
    /** @use SdkModel<MarkdownShape> */
    use SdkModel;

    /**
     * Return page content as Markdown.
     *
     * @var 'markdown' $format
     */
    #[Required]
    public string $format = 'markdown';

    /**
     * How to find pages to crawl.
     *
     * @var SourceVariants $source
     */
    #[Required(union: Source::class)]
    public StartURL|Sitemap $source;

    /**
     * Options for Markdown output.
     */
    #[Optional]
    public ?Options $options;

    /**
     * `new Markdown()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Markdown::with(source: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Markdown)->withSource(...)
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
     * @param SourceShape $source
     * @param Options|OptionsShape|null $options
     */
    public static function with(
        StartURL|array|Sitemap $source,
        Options|array|null $options = null
    ): self {
        $self = new self;

        $self['source'] = $source;

        null !== $options && $self['options'] = $options;

        return $self;
    }

    /**
     * Return page content as Markdown.
     *
     * @param 'markdown' $format
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * How to find pages to crawl.
     *
     * @param SourceShape $source
     */
    public function withSource(StartURL|array|Sitemap $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Options for Markdown output.
     *
     * @param Options|OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }
}
