<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByEmailResponse\Brand;

use ContextDev\Brand\BrandGetByEmailResponse\Brand\Industries\Eic;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Industry classification information for the brand.
 *
 * @phpstan-import-type EicShape from \ContextDev\Brand\BrandGetByEmailResponse\Brand\Industries\Eic
 *
 * @phpstan-type IndustriesShape = array{eic?: list<Eic|EicShape>|null}
 */
final class Industries implements BaseModel
{
    /** @use SdkModel<IndustriesShape> */
    use SdkModel;

    /**
     * Easy Industry Classification - array of industry and subindustry pairs.
     *
     * @var list<Eic>|null $eic
     */
    #[Optional(list: Eic::class)]
    public ?array $eic;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Eic|EicShape>|null $eic
     */
    public static function with(?array $eic = null): self
    {
        $self = new self;

        null !== $eic && $self['eic'] = $eic;

        return $self;
    }

    /**
     * Easy Industry Classification - array of industry and subindustry pairs.
     *
     * @param list<Eic|EicShape> $eic
     */
    public function withEic(array $eic): self
    {
        $self = clone $this;
        $self['eic'] = $eic;

        return $self;
    }
}
