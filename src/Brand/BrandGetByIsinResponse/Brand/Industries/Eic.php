<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByIsinResponse\Brand\Industries;

use ContextDev\Brand\BrandGetByIsinResponse\Brand\Industries\Eic\Industry;
use ContextDev\Brand\BrandGetByIsinResponse\Brand\Industries\Eic\Subindustry;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type EicShape = array{
 *   industry: Industry|value-of<Industry>,
 *   subindustry: Subindustry|value-of<Subindustry>,
 * }
 */
final class Eic implements BaseModel
{
    /** @use SdkModel<EicShape> */
    use SdkModel;

    /**
     * Industry classification enum.
     *
     * @var value-of<Industry> $industry
     */
    #[Required(enum: Industry::class)]
    public string $industry;

    /**
     * Subindustry classification enum.
     *
     * @var value-of<Subindustry> $subindustry
     */
    #[Required(enum: Subindustry::class)]
    public string $subindustry;

    /**
     * `new Eic()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Eic::with(industry: ..., subindustry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Eic)->withIndustry(...)->withSubindustry(...)
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
     * @param Industry|value-of<Industry> $industry
     * @param Subindustry|value-of<Subindustry> $subindustry
     */
    public static function with(
        Industry|string $industry,
        Subindustry|string $subindustry
    ): self {
        $self = new self;

        $self['industry'] = $industry;
        $self['subindustry'] = $subindustry;

        return $self;
    }

    /**
     * Industry classification enum.
     *
     * @param Industry|value-of<Industry> $industry
     */
    public function withIndustry(Industry|string $industry): self
    {
        $self = clone $this;
        $self['industry'] = $industry;

        return $self;
    }

    /**
     * Subindustry classification enum.
     *
     * @param Subindustry|value-of<Subindustry> $subindustry
     */
    public function withSubindustry(Subindustry|string $subindustry): self
    {
        $self = clone $this;
        $self['subindustry'] = $subindustry;

        return $self;
    }
}
