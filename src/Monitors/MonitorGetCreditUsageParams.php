<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * List credits charged per monitor, highest first, from up to the 10,000 most recent runs in the time window. Pass `tag` to report on one group of monitors, such as a single customer's.
 *
 * @see ContextDev\Services\MonitorsService::getCreditUsage()
 *
 * @phpstan-type MonitorGetCreditUsageParamsShape = array{
 *   since?: \DateTimeInterface|null,
 *   tag?: string|null,
 *   until?: \DateTimeInterface|null,
 * }
 */
final class MonitorGetCreditUsageParams implements BaseModel
{
    /** @use SdkModel<MonitorGetCreditUsageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Count only runs created at or after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $since;

    /**
     * Return usage only for monitors that currently have this tag. Deleted monitors are excluded.
     */
    #[Optional]
    public ?string $tag;

    /**
     * Count only runs created at or before this time.
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
        ?string $tag = null,
        ?\DateTimeInterface $until = null,
    ): self {
        $self = new self;

        null !== $since && $self['since'] = $since;
        null !== $tag && $self['tag'] = $tag;
        null !== $until && $self['until'] = $until;

        return $self;
    }

    /**
     * Count only runs created at or after this time.
     */
    public function withSince(\DateTimeInterface $since): self
    {
        $self = clone $this;
        $self['since'] = $since;

        return $self;
    }

    /**
     * Return usage only for monitors that currently have this tag. Deleted monitors are excluded.
     */
    public function withTag(string $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

        return $self;
    }

    /**
     * Count only runs created at or before this time.
     */
    public function withUntil(\DateTimeInterface $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }
}
