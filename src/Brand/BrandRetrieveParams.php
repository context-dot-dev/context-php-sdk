<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve logos, backdrops, colors, industry, description, and more. Provide exactly one lookup identifier in the request body: a domain, company name, email address, stock ticker, or transaction descriptor.
 *
 * @see ContextDev\Services\BrandService::retrieve()
 *
 * @phpstan-type BrandRetrieveParamsShape = array{
 *   domain: string,
 *   forceLanguage?: null|ForceLanguage|value-of<ForceLanguage>,
 *   maxAgeMs?: int|null,
 *   maxSpeed?: bool|null,
 *   timeoutMs?: int|null,
 *   name: string,
 *   countryGl?: string|null,
 *   email: string,
 *   ticker: string,
 *   tickerExchange?: string|null,
 *   transactionInfo: string,
 *   city?: string|null,
 *   highConfidenceOnly?: bool|null,
 *   mcc?: int|null,
 *   phone?: float|null,
 * }
 */
final class BrandRetrieveParams implements BaseModel
{
    /** @use SdkModel<BrandRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Domain name to retrieve brand data for (e.g., 'stripe.com').
     */
    #[Required]
    public string $domain;

    /** @var value-of<ForceLanguage>|null $forceLanguage */
    #[Optional('force_language', enum: ForceLanguage::class)]
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
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * Company name to retrieve brand data for (e.g., 'Apple Inc').
     */
    #[Required]
    public string $name;

    /**
     * Optional country code hint (GL parameter) to specify the country when identifying a transaction.
     */
    #[Optional('country_gl')]
    public ?string $countryGl;

    /**
     * Email address to retrieve brand data for (e.g., 'jane@stripe.com').
     */
    #[Required]
    public string $email;

    /**
     * Stock ticker symbol to retrieve brand data for (e.g., 'AAPL').
     */
    #[Required]
    public string $ticker;

    /**
     * Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
     */
    #[Optional('ticker_exchange')]
    public ?string $tickerExchange;

    /**
     * Transaction information to identify the brand.
     */
    #[Required('transaction_info')]
    public string $transactionInfo;

    /**
     * Optional city name to prioritize when searching for the brand.
     */
    #[Optional]
    public ?string $city;

    /**
     * When set to true, the API performs additional verification to ensure the identified brand matches the transaction with high confidence.
     */
    #[Optional('high_confidence_only')]
    public ?bool $highConfidenceOnly;

    /**
     * Optional Merchant Category Code (MCC) to help identify the business category or industry.
     */
    #[Optional]
    public ?int $mcc;

    /**
     * Optional phone number from the transaction to help verify brand match.
     */
    #[Optional]
    public ?float $phone;

    /**
     * `new BrandRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandRetrieveParams::with(
     *   domain: ..., name: ..., email: ..., ticker: ..., transactionInfo: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandRetrieveParams)
     *   ->withDomain(...)
     *   ->withName(...)
     *   ->withEmail(...)
     *   ->withTicker(...)
     *   ->withTransactionInfo(...)
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
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     */
    public static function with(
        string $domain,
        string $name,
        string $email,
        string $ticker,
        string $transactionInfo,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        ?int $timeoutMs = null,
        ?string $countryGl = null,
        ?string $tickerExchange = null,
        ?string $city = null,
        ?bool $highConfidenceOnly = null,
        ?int $mcc = null,
        ?float $phone = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['name'] = $name;
        $self['email'] = $email;
        $self['ticker'] = $ticker;
        $self['transactionInfo'] = $transactionInfo;

        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxSpeed && $self['maxSpeed'] = $maxSpeed;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $countryGl && $self['countryGl'] = $countryGl;
        null !== $tickerExchange && $self['tickerExchange'] = $tickerExchange;
        null !== $city && $self['city'] = $city;
        null !== $highConfidenceOnly && $self['highConfidenceOnly'] = $highConfidenceOnly;
        null !== $mcc && $self['mcc'] = $mcc;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * Domain name to retrieve brand data for (e.g., 'stripe.com').
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
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

    /**
     * Company name to retrieve brand data for (e.g., 'Apple Inc').
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional country code hint (GL parameter) to specify the country when identifying a transaction.
     */
    public function withCountryGl(string $countryGl): self
    {
        $self = clone $this;
        $self['countryGl'] = $countryGl;

        return $self;
    }

    /**
     * Email address to retrieve brand data for (e.g., 'jane@stripe.com').
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Stock ticker symbol to retrieve brand data for (e.g., 'AAPL').
     */
    public function withTicker(string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }

    /**
     * Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
     */
    public function withTickerExchange(string $tickerExchange): self
    {
        $self = clone $this;
        $self['tickerExchange'] = $tickerExchange;

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
     * When set to true, the API performs additional verification to ensure the identified brand matches the transaction with high confidence.
     */
    public function withHighConfidenceOnly(bool $highConfidenceOnly): self
    {
        $self = clone $this;
        $self['highConfidenceOnly'] = $highConfidenceOnly;

        return $self;
    }

    /**
     * Optional Merchant Category Code (MCC) to help identify the business category or industry.
     */
    public function withMcc(int $mcc): self
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
}
