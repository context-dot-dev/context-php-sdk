<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Baseline;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Current baseline of a `sitemap` monitor: the normalized URL set as last observed.
 *
 * @phpstan-type MonitorsSitemapBaselineShape = array{
 *   capturedAt: \DateTimeInterface, urlCount: int, urls: list<string>
 * }
 */
final class MonitorsSitemapBaseline implements BaseModel
{
    /** @use SdkModel<MonitorsSitemapBaselineShape> */
    use SdkModel;

    /**
     * When this baseline was last captured or replaced.
     */
    #[Required('captured_at')]
    public \DateTimeInterface $capturedAt;

    /**
     * Number of URLs in the baseline.
     */
    #[Required('url_count')]
    public int $urlCount;

    /**
     * The sitemap URLs as last observed (sorted, normalized).
     *
     * @var list<string> $urls
     */
    #[Required(list: 'string')]
    public array $urls;

    /**
     * `new MonitorsSitemapBaseline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSitemapBaseline::with(capturedAt: ..., urlCount: ..., urls: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsSitemapBaseline)
     *   ->withCapturedAt(...)
     *   ->withURLCount(...)
     *   ->withURLs(...)
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
     * @param list<string> $urls
     */
    public static function with(
        \DateTimeInterface $capturedAt,
        int $urlCount,
        array $urls
    ): self {
        $self = new self;

        $self['capturedAt'] = $capturedAt;
        $self['urlCount'] = $urlCount;
        $self['urls'] = $urls;

        return $self;
    }

    /**
     * When this baseline was last captured or replaced.
     */
    public function withCapturedAt(\DateTimeInterface $capturedAt): self
    {
        $self = clone $this;
        $self['capturedAt'] = $capturedAt;

        return $self;
    }

    /**
     * Number of URLs in the baseline.
     */
    public function withURLCount(int $urlCount): self
    {
        $self = clone $this;
        $self['urlCount'] = $urlCount;

        return $self;
    }

    /**
     * The sitemap URLs as last observed (sorted, normalized).
     *
     * @param list<string> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

        return $self;
    }
}
