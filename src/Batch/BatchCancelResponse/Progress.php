<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * How far the batch got before cancellation.
 *
 * @phpstan-type ProgressShape = array{failed: int, pending: int, succeeded: int}
 */
final class Progress implements BaseModel
{
    /** @use SdkModel<ProgressShape> */
    use SdkModel;

    /**
     * Pages that could not be scraped before the request landed.
     */
    #[Required]
    public int $failed;

    /**
     * Reserved pages that will now be skipped, and refunded when the batch settles.
     */
    #[Required]
    public int $pending;

    /**
     * Pages scraped successfully before the request landed.
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
     * Pages that could not be scraped before the request landed.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * Reserved pages that will now be skipped, and refunded when the batch settles.
     */
    public function withPending(int $pending): self
    {
        $self = clone $this;
        $self['pending'] = $pending;

        return $self;
    }

    /**
     * Pages scraped successfully before the request landed.
     */
    public function withSucceeded(int $succeeded): self
    {
        $self = clone $this;
        $self['succeeded'] = $succeeded;

        return $self;
    }
}
