<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse\Baseline;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Current baseline of an `extract` monitor: the structured data as last extracted.
 *
 * @phpstan-type MonitorsExtractBaselineShape = array{
 *   capturedAt: \DateTimeInterface, data: mixed, urlsAnalyzed: list<string>
 * }
 */
final class MonitorsExtractBaseline implements BaseModel
{
    /** @use SdkModel<MonitorsExtractBaselineShape> */
    use SdkModel;

    /**
     * When this baseline was last captured or replaced.
     */
    #[Required('captured_at')]
    public \DateTimeInterface $capturedAt;

    /**
     * The extracted structured data, matching the monitor's extraction schema (same shape as the /web/extract endpoint's `data`).
     */
    #[Required]
    public mixed $data;

    /**
     * URLs that were analyzed to produce the extracted data.
     *
     * @var list<string> $urlsAnalyzed
     */
    #[Required('urls_analyzed', list: 'string')]
    public array $urlsAnalyzed;

    /**
     * `new MonitorsExtractBaseline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsExtractBaseline::with(capturedAt: ..., data: ..., urlsAnalyzed: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsExtractBaseline)
     *   ->withCapturedAt(...)
     *   ->withData(...)
     *   ->withURLsAnalyzed(...)
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
     * @param list<string> $urlsAnalyzed
     */
    public static function with(
        \DateTimeInterface $capturedAt,
        mixed $data,
        array $urlsAnalyzed
    ): self {
        $self = new self;

        $self['capturedAt'] = $capturedAt;
        $self['data'] = $data;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

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
     * The extracted structured data, matching the monitor's extraction schema (same shape as the /web/extract endpoint's `data`).
     */
    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * URLs that were analyzed to produce the extracted data.
     *
     * @param list<string> $urlsAnalyzed
     */
    public function withURLsAnalyzed(array $urlsAnalyzed): self
    {
        $self = clone $this;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

        return $self;
    }
}
