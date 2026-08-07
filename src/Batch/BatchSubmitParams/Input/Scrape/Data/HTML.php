<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\Options;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\URL;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape the listed pages as HTML.
 *
 * @phpstan-import-type URLShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\URL
 * @phpstan-import-type OptionsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML\Options
 *
 * @phpstan-type HTMLShape = array{
 *   format: 'html', urls: list<URL|URLShape>, options?: null|Options|OptionsShape
 * }
 */
final class HTML implements BaseModel
{
    /** @use SdkModel<HTMLShape> */
    use SdkModel;

    /**
     * Return page content as HTML.
     *
     * @var 'html' $format
     */
    #[Required]
    public string $format = 'html';

    /**
     * Pages to scrape. Maximum 25000.
     *
     * @var list<URL> $urls
     */
    #[Required(list: URL::class)]
    public array $urls;

    /**
     * Options for HTML output.
     */
    #[Optional]
    public ?Options $options;

    /**
     * `new HTML()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * HTML::with(urls: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new HTML)->withURLs(...)
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
     * Return page content as HTML.
     *
     * @param 'html' $format
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
     * Options for HTML output.
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
