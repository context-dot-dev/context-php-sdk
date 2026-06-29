<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListChangesResponse\Data;

/**
 * @phpstan-import-type DataVariants from \ContextDev\Monitors\MonitorListChangesResponse\Data
 * @phpstan-import-type DataShape from \ContextDev\Monitors\MonitorListChangesResponse\Data
 *
 * @phpstan-type MonitorListChangesResponseShape = array{
 *   data: list<DataShape>, hasMore: bool, nextCursor: string|null
 * }
 */
final class MonitorListChangesResponse implements BaseModel
{
    /** @use SdkModel<MonitorListChangesResponseShape> */
    use SdkModel;

    /** @var list<DataVariants> $data */
    #[Required(list: Data::class)]
    public array $data;

    #[Required('has_more')]
    public bool $hasMore;

    #[Required('next_cursor')]
    public ?string $nextCursor;

    /**
     * `new MonitorListChangesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorListChangesResponse::with(data: ..., hasMore: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorListChangesResponse)
     *   ->withData(...)
     *   ->withHasMore(...)
     *   ->withNextCursor(...)
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
     * @param list<DataShape> $data
     */
    public static function with(
        array $data,
        bool $hasMore,
        ?string $nextCursor
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['hasMore'] = $hasMore;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
