<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Location context to help identify the person. Provide a city, region, or country.
 *
 * @phpstan-type LocationShape = array{
 *   city?: string|null, country?: string|null, region?: string|null
 * }
 */
final class Location implements BaseModel
{
    /** @use SdkModel<LocationShape> */
    use SdkModel;

    /**
     * City associated with the person.
     */
    #[Optional]
    public ?string $city;

    /**
     * Country associated with the person.
     */
    #[Optional]
    public ?string $country;

    /**
     * State, province, or region associated with the person.
     */
    #[Optional]
    public ?string $region;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $city = null,
        ?string $country = null,
        ?string $region = null
    ): self {
        $self = new self;

        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $region && $self['region'] = $region;

        return $self;
    }

    /**
     * City associated with the person.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Country associated with the person.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * State, province, or region associated with the person.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }
}
