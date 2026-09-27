<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Return usage per monitor, highest first, for up to the 10,000 most recent runs in the requested window.
 *
 * @see ContextDev\Services\MonitorsService::getCreditUsage()
 *
 * @phpstan-type MonitorGetCreditUsageParamsShape = array{
 *   since?: \DateTimeInterface|null, until?: \DateTimeInterface|null
 * }
 */
final class MonitorGetCreditUsageParams implements BaseModel
{
    /** @use SdkModel<MonitorGetCreditUsageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Only include items at or after this ISO 8601 timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $since;

    /**
     * Only include items before this ISO 8601 timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $until;

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
        ?\DateTimeInterface $since = null,
        ?\DateTimeInterface $until = null
    ): self {
        $self = new self;

        null !== $since && $self['since'] = $since;
        null !== $until && $self['until'] = $until;

        return $self;
    }

    /**
     * Only include items at or after this ISO 8601 timestamp.
     */
    public function withSince(\DateTimeInterface $since): self
    {
        $self = clone $this;
        $self['since'] = $since;

        return $self;
    }

    /**
     * Only include items before this ISO 8601 timestamp.
     */
    public function withUntil(\DateTimeInterface $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }
}
