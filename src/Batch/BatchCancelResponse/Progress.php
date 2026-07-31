<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Current processing counts. Use `status` to check completion.
 *
 * @phpstan-type ProgressShape = array{failed: int, pending: int, succeeded: int}
 */
final class Progress implements BaseModel
{
    /** @use SdkModel<ProgressShape> */
    use SdkModel;

    /**
     * Pages that could not be scraped.
     */
    #[Required]
    public int $failed;

    /**
     * Accepted pages not yet attempted. Always 0 once the batch completes; a crawl can finish under its page limit when the site has no more reachable pages.
     */
    #[Required]
    public int $pending;

    /**
     * Pages scraped successfully.
     */
    #[Required]
    public int $succeeded;

    /**
     * `new Progress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Progress::with(failed: ..., pending: ..., succeeded: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Progress)->withFailed(...)->withPending(...)->withSucceeded(...)
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
    public static function with(int $failed, int $pending, int $succeeded): self
    {
        $self = new self;

        $self['failed'] = $failed;
        $self['pending'] = $pending;
        $self['succeeded'] = $succeeded;

        return $self;
    }

    /**
     * Pages that could not be scraped.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * Accepted pages not yet attempted. Always 0 once the batch completes; a crawl can finish under its page limit when the site has no more reachable pages.
     */
    public function withPending(int $pending): self
    {
        $self = clone $this;
        $self['pending'] = $pending;

        return $self;
    }

    /**
     * Pages scraped successfully.
     */
    public function withSucceeded(int $succeeded): self
    {
        $self = clone $this;
        $self['succeeded'] = $succeeded;

        return $self;
    }
}
