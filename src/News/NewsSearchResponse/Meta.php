<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MetaShape = array{count: int}
 */
final class Meta implements BaseModel
{
    /** @use SdkModel<MetaShape> */
    use SdkModel;

    #[Required]
    public int $count;

    /**
     * `new Meta()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Meta::with(count: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Meta)->withCount(...)
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
    public static function with(int $count): self
    {
        $self = new self;

        $self['count'] = $count;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }
}
