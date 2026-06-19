<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandRetrieveByNameParams\CountryGl;
use ContextDev\Brand\BrandRetrieveByNameParams\ForceLanguage;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve brand information using a company name.
 *
 * @see ContextDev\Services\BrandService::retrieveByName()
 *
 * @phpstan-type BrandRetrieveByNameParamsShape = array{
 *   name: string,
 *   countryGl?: null|CountryGl|value-of<CountryGl>,
 *   forceLanguage?: null|ForceLanguage|value-of<ForceLanguage>,
 *   maxAgeMs?: int|null,
 *   maxSpeed?: bool|null,
 *   timeoutMs?: int|null,
 * }
 */
final class BrandRetrieveByNameParams implements BaseModel
{
    /** @use SdkModel<BrandRetrieveByNameParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Company name to retrieve brand data for (e.g., 'Apple Inc', 'Microsoft Corporation'). Must be 3-30 characters.
     */
    #[Required]
    public string $name;

    /**
     * Optional country code hint (GL parameter) to specify the country for the company name.
     *
     * @var value-of<CountryGl>|null $countryGl
     */
    #[Optional(enum: CountryGl::class)]
    public ?string $countryGl;

    /**
     * Optional parameter to force the language of the retrieved brand data.
     *
     * @var value-of<ForceLanguage>|null $forceLanguage
     */
    #[Optional(enum: ForceLanguage::class)]
    public ?string $forceLanguage;

    /**
     * Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     */
    #[Optional]
    public ?bool $maxSpeed;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * `new BrandRetrieveByNameParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandRetrieveByNameParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandRetrieveByNameParams)->withName(...)
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
     * @param CountryGl|value-of<CountryGl>|null $countryGl
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     */
    public static function with(
        string $name,
        CountryGl|string|null $countryGl = null,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $countryGl && $self['countryGl'] = $countryGl;
        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxSpeed && $self['maxSpeed'] = $maxSpeed;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Company name to retrieve brand data for (e.g., 'Apple Inc', 'Microsoft Corporation'). Must be 3-30 characters.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional country code hint (GL parameter) to specify the country for the company name.
     *
     * @param CountryGl|value-of<CountryGl> $countryGl
     */
    public function withCountryGl(CountryGl|string $countryGl): self
    {
        $self = clone $this;
        $self['countryGl'] = $countryGl;

        return $self;
    }

    /**
     * Optional parameter to force the language of the retrieved brand data.
     *
     * @param ForceLanguage|value-of<ForceLanguage> $forceLanguage
     */
    public function withForceLanguage(ForceLanguage|string $forceLanguage): self
    {
        $self = clone $this;
        $self['forceLanguage'] = $forceLanguage;

        return $self;
    }

    /**
     * Maximum age in milliseconds for cached brand data before the API performs a hard refresh. Defaults to 3 months (7776000000 ms). Values below 1 day (86400000 ms) are clamped to 1 day; values above 1 year (31536000000 ms) are clamped to 1 year.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     */
    public function withMaxSpeed(bool $maxSpeed): self
    {
        $self = clone $this;
        $self['maxSpeed'] = $maxSpeed;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
