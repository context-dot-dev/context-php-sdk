<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\SearchBy\Entity;
use ContextDev\News\NewsSearchParams\SearchBy\Entity\NewsSearchEntityByDomain;
use ContextDev\News\NewsSearchParams\SearchBy\Entity\NewsSearchEntityByIsin;
use ContextDev\News\NewsSearchParams\SearchBy\Entity\NewsSearchEntityByName;
use ContextDev\News\NewsSearchParams\SearchBy\Entity\NewsSearchEntityByTicker;
use ContextDev\News\NewsSearchParams\SearchBy\Type;

/**
 * What to search for.
 *
 * @phpstan-import-type EntityVariants from \ContextDev\News\NewsSearchParams\SearchBy\Entity
 * @phpstan-import-type EntityShape from \ContextDev\News\NewsSearchParams\SearchBy\Entity
 *
 * @phpstan-type SearchByShape = array{
 *   entity: EntityShape, type: Type|value-of<Type>
 * }
 */
final class SearchBy implements BaseModel
{
    /** @use SdkModel<SearchByShape> */
    use SdkModel;

    /**
     * The company to search news for, identified by name, domain, ticker, or ISIN.
     *
     * @var EntityVariants $entity
     */
    #[Required(union: Entity::class)]
    public NewsSearchEntityByName|NewsSearchEntityByDomain|NewsSearchEntityByTicker|NewsSearchEntityByIsin $entity;

    /**
     * How to search. Only entity search is supported.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new SearchBy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SearchBy::with(entity: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SearchBy)->withEntity(...)->withType(...)
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
     * @param EntityShape $entity
     * @param Type|value-of<Type> $type
     */
    public static function with(
        NewsSearchEntityByName|array|NewsSearchEntityByDomain|NewsSearchEntityByTicker|NewsSearchEntityByIsin $entity,
        Type|string $type,
    ): self {
        $self = new self;

        $self['entity'] = $entity;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The company to search news for, identified by name, domain, ticker, or ISIN.
     *
     * @param EntityShape $entity
     */
    public function withEntity(
        NewsSearchEntityByName|array|NewsSearchEntityByDomain|NewsSearchEntityByTicker|NewsSearchEntityByIsin $entity,
    ): self {
        $self = clone $this;
        $self['entity'] = $entity;

        return $self;
    }

    /**
     * How to search. Only entity search is supported.
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
