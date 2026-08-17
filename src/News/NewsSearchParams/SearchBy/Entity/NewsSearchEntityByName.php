<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy\Entity;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Identify the company by name.
 *
 * @phpstan-type NewsSearchEntityByNameShape = array{name: string, type: 'name'}
 */
final class NewsSearchEntityByName implements BaseModel
{
    /** @use SdkModel<NewsSearchEntityByNameShape> */
    use SdkModel;

    /** @var 'name' $type */
    #[Required]
    public string $type = 'name';

    /**
     * Company name.
     */
    #[Required]
    public string $name;

    /**
     * `new NewsSearchEntityByName()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchEntityByName::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchEntityByName)->withName(...)
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
    public static function with(string $name): self
    {
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    /**
     * Company name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param 'name' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
