<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Scholar\ScholarSearchParams\FilterBy\Date;

/**
 * Filter by publication date.
 *
 * @phpstan-import-type DateShape from \ContextDev\Scholar\ScholarSearchParams\FilterBy\Date
 *
 * @phpstan-type FilterByShape = array{date?: null|Date|DateShape}
 */
final class FilterBy implements BaseModel
{
    /** @use SdkModel<FilterByShape> */
    use SdkModel;

    /**
     * Publication date range. Undated papers are excluded.
     */
    #[Optional]
    public ?Date $date;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Date|DateShape|null $date
     */
    public static function with(Date|array|null $date = null): self
    {
        $self = new self;

        null !== $date && $self['date'] = $date;

        return $self;
    }

    /**
     * Publication date range. Undated papers are excluded.
     *
     * @param Date|DateShape $date
     */
    public function withDate(Date|array $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }
}
