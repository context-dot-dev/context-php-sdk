<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand;

use ContextDev\Brand\BrandGetResponse\Brand\Employees\Range;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Employee headcount information for the brand (will be null if unknown).
 *
 * @phpstan-type EmployeesShape = array{
 *   exact?: int|null, range?: null|Range|value-of<Range>
 * }
 */
final class Employees implements BaseModel
{
    /** @use SdkModel<EmployeesShape> */
    use SdkModel;

    /**
     * Exact employee count when a precise headcount is known.
     */
    #[Optional]
    public ?int $exact;

    /**
     * Employee count range for the brand (e.g. '11 to 50').
     *
     * @var value-of<Range>|null $range
     */
    #[Optional(enum: Range::class)]
    public ?string $range;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Range|value-of<Range>|null $range
     */
    public static function with(
        ?int $exact = null,
        Range|string|null $range = null
    ): self {
        $self = new self;

        null !== $exact && $self['exact'] = $exact;
        null !== $range && $self['range'] = $range;

        return $self;
    }

    /**
     * Exact employee count when a precise headcount is known.
     */
    public function withExact(int $exact): self
    {
        $self = clone $this;
        $self['exact'] = $exact;

        return $self;
    }

    /**
     * Employee count range for the brand (e.g. '11 to 50').
     *
     * @param Range|value-of<Range> $range
     */
    public function withRange(Range|string $range): self
    {
        $self = clone $this;
        $self['range'] = $range;

        return $self;
    }
}
