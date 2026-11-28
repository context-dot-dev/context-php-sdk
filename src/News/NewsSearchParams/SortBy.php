<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\SortBy\Type;

/**
 * How to order results. Company searches default to `newest`; natural-language searches always use `relevance`.
 *
 * @phpstan-type SortByShape = array{type: Type|value-of<Type>}
 */
final class SortBy implements BaseModel
{
    /** @use SdkModel<SortByShape> */
    use SdkModel;

    /**
     * `newest` puts the most recently published articles first; `relevance` puts the closest matches first.
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
     * `newest` puts the most recently published articles first; `relevance` puts the closest matches first.
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
