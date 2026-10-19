<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByDomain;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByIsin;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByName;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByTicker;

/**
 * Find news about a specific company.
 *
 * @phpstan-import-type EntityVariants from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity
 * @phpstan-import-type EntityShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity
 *
 * @phpstan-type NewsSearchByEntityShape = array{
 *   entity: EntityShape, type: 'entity'
 * }
 */
final class NewsSearchByEntity implements BaseModel
{
    /** @use SdkModel<NewsSearchByEntityShape> */
    use SdkModel;

    /**
     * Use `entity` to find news about a specific company.
     *
     * @var 'entity' $type
     */
    #[Required]
    public string $type = 'entity';

    /**
     * The company to search news for, identified by name, domain, ticker, or ISIN.
     *
     * @var EntityVariants $entity
     */
    #[Required(union: Entity::class)]
    public NewsSearchEntityByName|NewsSearchEntityByDomain|NewsSearchEntityByTicker|NewsSearchEntityByIsin $entity;

    /**
     * `new NewsSearchByEntity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchByEntity::with(entity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchByEntity)->withEntity(...)
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
     */
    public static function with(
        NewsSearchEntityByName|array|NewsSearchEntityByDomain|NewsSearchEntityByTicker|NewsSearchEntityByIsin $entity,
    ): self {
        $self = new self;

        $self['entity'] = $entity;

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
     * Use `entity` to find news about a specific company.
     *
     * @param 'entity' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
