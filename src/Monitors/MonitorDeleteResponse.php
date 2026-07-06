<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MonitorDeleteResponseShape = array{id: string, deleted: bool}
 */
final class MonitorDeleteResponse implements BaseModel
{
    /** @use SdkModel<MonitorDeleteResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public bool $deleted;

    /**
     * `new MonitorDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorDeleteResponse::with(id: ..., deleted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorDeleteResponse)->withID(...)->withDeleted(...)
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
    public static function with(string $id, bool $deleted): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['deleted'] = $deleted;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withDeleted(bool $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

        return $self;
    }
}
