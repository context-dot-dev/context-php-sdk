<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListAccountRunsParams\Status;

/**
 * Returns an account-wide feed of monitor runs across all monitors.
 *
 * @see ContextDev\Services\MonitorsService::listAccountRuns()
 *
 * @phpstan-type MonitorListAccountRunsParamsShape = array{
 *   cursor?: string|null, limit?: int|null, status?: null|Status|value-of<Status>
 * }
 */
final class MonitorListAccountRunsParams implements BaseModel
{
    /** @use SdkModel<MonitorListAccountRunsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?int $limit;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $cursor = null,
        ?int $limit = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
