<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse\Baseline;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Baseline for a `page` target: the page's visible text from the last capture.
 *
 * @phpstan-type MonitorsPageBaselineShape = array{
 *   capturedAt: \DateTimeInterface, text: string
 * }
 */
final class MonitorsPageBaseline implements BaseModel
{
    /** @use SdkModel<MonitorsPageBaselineShape> */
    use SdkModel;

    /**
     * When the baseline was last captured or updated.
     */
    #[Required('captured_at')]
    public \DateTimeInterface $capturedAt;

    /**
     * Visible page text from the last capture.
     */
    #[Required]
    public string $text;

    /**
     * `new MonitorsPageBaseline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsPageBaseline::with(capturedAt: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsPageBaseline)->withCapturedAt(...)->withText(...)
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
    public static function with(
        \DateTimeInterface $capturedAt,
        string $text
    ): self {
        $self = new self;

        $self['capturedAt'] = $capturedAt;
        $self['text'] = $text;

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
     * Visible page text from the last capture.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
