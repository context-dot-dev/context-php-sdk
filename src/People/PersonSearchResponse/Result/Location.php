<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchResponse\Result;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Where the person lives.
 *
 * @phpstan-type LocationShape = array{
 *   city: string|null, countryCode: string|null, region: string|null
 * }
 */
final class Location implements BaseModel
{
    /** @use SdkModel<LocationShape> */
    use SdkModel;

    /**
     * City.
     */
    #[Required]
    public ?string $city;

    /**
     * Country as a two-letter code, such as US or GB.
     */
    #[Required('country_code')]
    public ?string $countryCode;

    /**
     * State or region.
     */
    #[Required]
    public ?string $region;

    /**
     * `new Location()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Location::with(city: ..., countryCode: ..., region: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Location)->withCity(...)->withCountryCode(...)->withRegion(...)
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
    public static function with(
        ?string $city,
        ?string $countryCode,
        ?string $region
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['countryCode'] = $countryCode;
        $self['region'] = $region;

        return $self;
    }

    /**
     * City.
     */
    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Country as a two-letter code, such as US or GB.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * State or region.
     */
    public function withRegion(?string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }
}
