<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\SortBy\Type;

/**
 * Result ordering. Defaults to newest.
 *
 * @phpstan-type SortByShape = array{type: Type|value-of<Type>}
 */
final class SortBy implements BaseModel
{
    /** @use SdkModel<SortByShape> */
    use SdkModel;

    /**
     * Result ordering.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new SortBy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SortBy::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SortBy)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(Type|string $type): self
    {
        $self = new self;

        $self['type'] = $type;

        return $self;
    }

    /**
     * Result ordering.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
