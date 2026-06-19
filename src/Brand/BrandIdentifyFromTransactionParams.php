<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandIdentifyFromTransactionParams\CountryGl;
use ContextDev\Brand\BrandIdentifyFromTransactionParams\ForceLanguage;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Endpoint specially designed for platforms that want to identify transaction data by the transaction title.
 *
 * @see ContextDev\Services\BrandService::identifyFromTransaction()
 *
 * @phpstan-type BrandIdentifyFromTransactionParamsShape = array{
 *   transactionInfo: string,
 *   city?: string|null,
 *   countryGl?: null|CountryGl|value-of<CountryGl>,
 *   forceLanguage?: null|ForceLanguage|value-of<ForceLanguage>,
 *   highConfidenceOnly?: bool|null,
 *   maxSpeed?: bool|null,
 *   mcc?: string|null,
 *   phone?: float|null,
 *   timeoutMs?: int|null,
 * }
 */
final class BrandIdentifyFromTransactionParams implements BaseModel
{
    /** @use SdkModel<BrandIdentifyFromTransactionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Transaction information to identify the brand.
     */
    #[Required]
    public string $transactionInfo;

    /**
     * Optional city name to prioritize when searching for the brand.
     */
    #[Optional]
    public ?string $city;

    /**
     * Optional country code (GL parameter) to specify the country. This affects the geographic location used for search queries.
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
     * When set to true, the API will perform an additional verification steps to ensure the identified brand matches the transaction with high confidence.
     */
    #[Optional]
    public ?bool $highConfidenceOnly;

    /**
     * Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     */
    #[Optional]
    public ?bool $maxSpeed;

    /**
     * Optional Merchant Category Code (MCC) to help identify the business category/industry.
     */
    #[Optional]
    public ?string $mcc;

    /**
     * Optional phone number from the transaction to help verify brand match.
     */
    #[Optional]
    public ?float $phone;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * `new BrandIdentifyFromTransactionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandIdentifyFromTransactionParams::with(transactionInfo: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandIdentifyFromTransactionParams)->withTransactionInfo(...)
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
        string $transactionInfo,
        ?string $city = null,
        CountryGl|string|null $countryGl = null,
        ForceLanguage|string|null $forceLanguage = null,
        ?bool $highConfidenceOnly = null,
        ?bool $maxSpeed = null,
        ?string $mcc = null,
        ?float $phone = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['transactionInfo'] = $transactionInfo;

        null !== $city && $self['city'] = $city;
        null !== $countryGl && $self['countryGl'] = $countryGl;
        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $highConfidenceOnly && $self['highConfidenceOnly'] = $highConfidenceOnly;
        null !== $maxSpeed && $self['maxSpeed'] = $maxSpeed;
        null !== $mcc && $self['mcc'] = $mcc;
        null !== $phone && $self['phone'] = $phone;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Transaction information to identify the brand.
     */
    public function withTransactionInfo(string $transactionInfo): self
    {
        $self = clone $this;
        $self['transactionInfo'] = $transactionInfo;

        return $self;
    }

    /**
     * Optional city name to prioritize when searching for the brand.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Optional country code (GL parameter) to specify the country. This affects the geographic location used for search queries.
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
     * When set to true, the API will perform an additional verification steps to ensure the identified brand matches the transaction with high confidence.
     */
    public function withHighConfidenceOnly(bool $highConfidenceOnly): self
    {
        $self = clone $this;
        $self['highConfidenceOnly'] = $highConfidenceOnly;

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
     * Optional Merchant Category Code (MCC) to help identify the business category/industry.
     */
    public function withMcc(string $mcc): self
    {
        $self = clone $this;
        $self['mcc'] = $mcc;

        return $self;
    }

    /**
     * Optional phone number from the transaction to help verify brand match.
     */
    public function withPhone(float $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

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
