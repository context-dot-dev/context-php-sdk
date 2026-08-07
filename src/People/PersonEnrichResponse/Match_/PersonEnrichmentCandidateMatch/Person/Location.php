<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type LocationShape = array{
 *   city?: string|null,
 *   country?: string|null,
 *   countryCode?: string|null,
 *   display?: string|null,
 *   region?: string|null,
 * }
 */
final class Location implements BaseModel
{
    /** @use SdkModel<LocationShape> */
    use SdkModel;

    #[Optional]
    public ?string $city;

    #[Optional]
    public ?string $country;

    #[Optional('country_code')]
    public ?string $countryCode;

    #[Optional]
    public ?string $display;

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
        ?string $countryCode = null,
        ?string $display = null,
        ?string $region = null,
    ): self {
        $self = new self;

        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $display && $self['display'] = $display;
        null !== $region && $self['region'] = $region;

        return $self;
    }

    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    public function withDisplay(string $display): self
    {
        $self = clone $this;
        $self['display'] = $display;

        return $self;
    }

    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }
}
