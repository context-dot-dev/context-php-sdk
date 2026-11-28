<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Baseline;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSearchBaseline\Result;

/**
 * Baseline for a `search` target: the results from the last capture.
 *
 * @phpstan-import-type ResultShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSearchBaseline\Result
 *
 * @phpstan-type MonitorsSearchBaselineShape = array{
 *   capturedAt: \DateTimeInterface, results: list<Result|ResultShape>
 * }
 */
final class MonitorsSearchBaseline implements BaseModel
{
    /** @use SdkModel<MonitorsSearchBaselineShape> */
    use SdkModel;

    /**
     * When the baseline was last captured or updated.
     */
    #[Required('captured_at')]
    public \DateTimeInterface $capturedAt;

    /**
     * Search results from the last capture.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * `new MonitorsSearchBaseline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSearchBaseline::with(capturedAt: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsSearchBaseline)->withCapturedAt(...)->withResults(...)
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
     * @param list<Result|ResultShape> $results
     */
    public static function with(
        \DateTimeInterface $capturedAt,
        array $results
    ): self {
        $self = new self;

        $self['capturedAt'] = $capturedAt;
        $self['results'] = $results;

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
     * Search results from the last capture.
     *
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
