<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListRunsParams\Status;

/**
 * List monitor runs.
 *
 * @see ContextDev\Services\MonitorsService::listRuns()
 *
 * @phpstan-type MonitorListRunsParamsShape = array{
 *   cursor?: string|null, limit?: int|null, status?: null|Status|value-of<Status>
 * }
 */
final class MonitorListRunsParams implements BaseModel
{
    /** @use SdkModel<MonitorListRunsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Opaque pagination cursor from a previous response.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of items to return per page (1-100). Defaults to 25.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter runs by lifecycle status.
     *
     * @var value-of<Status>|null $status
     */
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

    /**
     * Opaque pagination cursor from a previous response.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of items to return per page (1-100). Defaults to 25.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter runs by lifecycle status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
