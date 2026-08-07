<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown\Options;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown\URL;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape the listed pages as Markdown.
 *
 * @phpstan-import-type URLShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown\URL
 * @phpstan-import-type OptionsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown\Options
 *
 * @phpstan-type MarkdownShape = array{
 *   format: 'markdown',
 *   urls: list<URL|URLShape>,
 *   options?: null|Options|OptionsShape,
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
     * Pages to scrape. Maximum 25000.
     *
     * @var list<URL> $urls
     */
    #[Required(list: URL::class)]
    public array $urls;

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
     * Markdown::with(urls: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Markdown)->withURLs(...)
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
     * @param list<URL|URLShape> $urls
     * @param Options|OptionsShape|null $options
     */
    public static function with(
        array $urls,
        Options|array|null $options = null
    ): self {
        $self = new self;

        $self['urls'] = $urls;

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
     * Pages to scrape. Maximum 25000.
     *
     * @param list<URL|URLShape> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

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
