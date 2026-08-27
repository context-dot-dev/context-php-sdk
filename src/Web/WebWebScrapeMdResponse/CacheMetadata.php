<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeMdResponse\CacheMetadata\Status;

/**
 * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
 *
 * @phpstan-type CacheMetadataShape = array{
 *   ageMs: int, status: Status|value-of<Status>
 * }
 */
final class CacheMetadata implements BaseModel
{
    /** @use SdkModel<CacheMetadataShape> */
    use SdkModel;

    /**
     * Age of the cached data in milliseconds. Zero for miss and zdr responses.
     */
    #[Required('age_ms')]
    public int $ageMs;

    /**
     * Whether the response was served from cache, required fresh work, or honored zero-data-retention cache bypass.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new CacheMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CacheMetadata::with(ageMs: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CacheMetadata)->withAgeMs(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(int $ageMs, Status|string $status): self
    {
        $self = new self;

        $self['ageMs'] = $ageMs;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Age of the cached data in milliseconds. Zero for miss and zdr responses.
     */
    public function withAgeMs(int $ageMs): self
    {
        $self = clone $this;
        $self['ageMs'] = $ageMs;

        return $self;
    }

    /**
     * Whether the response was served from cache, required fresh work, or honored zero-data-retention cache bypass.
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
