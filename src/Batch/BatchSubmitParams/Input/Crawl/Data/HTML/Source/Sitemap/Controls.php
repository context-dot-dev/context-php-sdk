<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\Sitemap;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for the sitemap URLs. A sitemap batch scrapes exactly those URLs and never follows links off them, so there is no crawl depth here.
 *
 * @phpstan-type ControlsShape = array{maxURLs?: int|null, regex?: string|null}
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 25000.
     */
    #[Optional('maxUrls')]
    public ?int $maxURLs;

    /**
     * RE2 pattern; only sitemap URLs matching it are scraped.
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
    public static function with(?int $maxURLs = null, ?string $regex = null): self
    {
        $self = new self;

        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $regex && $self['regex'] = $regex;

        return $self;
    }

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 25000.
     */
    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }

    /**
     * RE2 pattern; only sitemap URLs matching it are scraped.
     */
    public function withRegex(string $regex): self
    {
        $self = clone $this;
        $self['regex'] = $regex;

        return $self;
    }
}
