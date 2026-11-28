<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorNewResponse\Baseline;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Baseline for an `extract` target: the tracked pages and the data last extracted from them.
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
     * When the baseline was last captured or updated.
     */
    #[Required('captured_at')]
    public \DateTimeInterface $capturedAt;

    /**
     * Latest extracted data, matching the target's `schema`. Refreshed at most once a day; `null` before the first capture.
     */
    #[Required]
    public mixed $data;

    /**
     * Pages the monitor tracks for changes.
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
     * When the baseline was last captured or updated.
     */
    public function withCapturedAt(\DateTimeInterface $capturedAt): self
    {
        $self = clone $this;
        $self['capturedAt'] = $capturedAt;

        return $self;
    }

    /**
     * Latest extracted data, matching the target's `schema`. Refreshed at most once a day; `null` before the first capture.
     */
    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Pages the monitor tracks for changes.
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
