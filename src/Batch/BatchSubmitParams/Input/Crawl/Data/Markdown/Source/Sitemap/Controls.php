<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Source\Sitemap;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for the sitemap URLs. A sitemap batch scrapes exactly those URLs and never follows links off them, so there is no crawl depth here.
 *
 * @phpstan-type ControlsShape = array{
 *   excludeRegex?: string|null, maxURLs?: int|null, regex?: string|null
 * }
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

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
     */
    public static function with(
        ?string $excludeRegex = null,
        ?int $maxURLs = null,
        ?string $regex = null
    ): self {
        $self = new self;

        null !== $excludeRegex && $self['excludeRegex'] = $excludeRegex;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $regex && $self['regex'] = $regex;

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
