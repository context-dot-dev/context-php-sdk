<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for the sitemap URLs. A sitemap batch scrapes exactly those URLs and never follows links off them, so there is no crawl depth here.
 *
 * @phpstan-type ControlsShape = array{
 *   excludePaths?: list<string>|null,
 *   excludeRegex?: string|null,
 *   maxURLs?: int|null,
 *   regex?: string|null,
 * }
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

    /**
     * Path fragments that skip a sitemap URL in a crawl. Works separately from any regex inclusion or exclusion you define. Defaults to ["/feed","/rss","/atom","/api/","/cdn-cgi/","/_next/","/__"]. Pass `[]` to keep every listed URL.
     *
     * @var list<string>|null $excludePaths
     */
    #[Optional(list: 'string')]
    public ?array $excludePaths;

    /**
     * Regex pattern; sitemap URLs matching it are not scraped, even when they match `regex`.
     */
    #[Optional]
    public ?string $excludeRegex;

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 100000.
     */
    #[Optional('maxUrls')]
    public ?int $maxURLs;

    /**
     * Regex pattern; only sitemap URLs matching it are scraped.
     */
    #[Optional]
    public ?string $regex;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $excludePaths
     */
    public static function with(
        ?array $excludePaths = null,
        ?string $excludeRegex = null,
        ?int $maxURLs = null,
        ?string $regex = null,
    ): self {
        $self = new self;

        null !== $excludePaths && $self['excludePaths'] = $excludePaths;
        null !== $excludeRegex && $self['excludeRegex'] = $excludeRegex;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $regex && $self['regex'] = $regex;

        return $self;
    }

    /**
     * Path fragments that skip a sitemap URL in a crawl. Works separately from any regex inclusion or exclusion you define. Defaults to ["/feed","/rss","/atom","/api/","/cdn-cgi/","/_next/","/__"]. Pass `[]` to keep every listed URL.
     *
     * @param list<string> $excludePaths
     */
    public function withExcludePaths(array $excludePaths): self
    {
        $self = clone $this;
        $self['excludePaths'] = $excludePaths;

        return $self;
    }

    /**
     * Regex pattern; sitemap URLs matching it are not scraped, even when they match `regex`.
     */
    public function withExcludeRegex(string $excludeRegex): self
    {
        $self = clone $this;
        $self['excludeRegex'] = $excludeRegex;

        return $self;
    }

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 100000.
     */
    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }

    /**
     * Regex pattern; only sitemap URLs matching it are scraped.
     */
    public function withRegex(string $regex): self
    {
        $self = clone $this;
        $self['regex'] = $regex;

        return $self;
    }
}
