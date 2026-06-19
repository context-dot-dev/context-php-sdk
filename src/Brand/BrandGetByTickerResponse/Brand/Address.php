<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByTickerResponse\Brand;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Physical address of the brand.
 *
 * @phpstan-type AddressShape = array{
 *   city?: string|null,
 *   country?: string|null,
 *   countryCode?: string|null,
 *   postalCode?: string|null,
 *   stateCode?: string|null,
 *   stateProvince?: string|null,
 *   street?: string|null,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * City name.
     */
    #[Optional]
    public ?string $city;

    /**
     * Country name.
     */
    #[Optional]
    public ?string $country;

    /**
     * Country code.
     */
    #[Optional('country_code')]
    public ?string $countryCode;

    /**
     * Postal or ZIP code.
     */
    #[Optional('postal_code')]
    public ?string $postalCode;

    /**
     * State or province code.
     */
    #[Optional('state_code')]
    public ?string $stateCode;

    /**
     * State or province name.
     */
    #[Optional('state_province')]
    public ?string $stateProvince;

    /**
     * Street address.
     */
    #[Optional]
    public ?string $street;

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
        ?string $postalCode = null,
        ?string $stateCode = null,
        ?string $stateProvince = null,
        ?string $street = null,
    ): self {
        $self = new self;

        null !== $city && $self['city'] = $city;
        null !== $country && $self['country'] = $country;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $stateCode && $self['stateCode'] = $stateCode;
        null !== $stateProvince && $self['stateProvince'] = $stateProvince;
        null !== $street && $self['street'] = $street;

        return $self;
    }

    /**
     * City name.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Country name.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Postal or ZIP code.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * State or province code.
     */
    public function withStateCode(string $stateCode): self
    {
        $self = clone $this;
        $self['stateCode'] = $stateCode;

        return $self;
    }

    /**
     * State or province name.
     */
    public function withStateProvince(string $stateProvince): self
    {
        $self = clone $this;
        $self['stateProvince'] = $stateProvince;

        return $self;
    }

    /**
     * Street address.
     */
    public function withStreet(string $street): self
    {
        $self = clone $this;
        $self['street'] = $street;

        return $self;
    }
}
