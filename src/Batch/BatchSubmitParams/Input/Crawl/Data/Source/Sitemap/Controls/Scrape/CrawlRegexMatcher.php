<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Scrape;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Pages whose URL matches a regex pattern.
 *
 * @phpstan-type CrawlRegexMatcherShape = array{kind: 'regex', pattern: string}
 */
final class CrawlRegexMatcher implements BaseModel
{
    /** @use SdkModel<CrawlRegexMatcherShape> */
    use SdkModel;

    /**
     * Match pages by URL pattern.
     *
     * @var 'regex' $kind
     */
    #[Required]
    public string $kind = 'regex';

    /**
     * Regex pattern for the page URL.
     */
    #[Required]
    public string $pattern;

    /**
     * `new CrawlRegexMatcher()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CrawlRegexMatcher::with(pattern: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CrawlRegexMatcher)->withPattern(...)
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
     */
    public static function with(string $pattern): self
    {
        $self = new self;

        $self['pattern'] = $pattern;

        return $self;
    }

    /**
     * Match pages by URL pattern.
     *
     * @param 'regex' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * Regex pattern for the page URL.
     */
    public function withPattern(string $pattern): self
    {
        $self = clone $this;
        $self['pattern'] = $pattern;

        return $self;
    }
}
