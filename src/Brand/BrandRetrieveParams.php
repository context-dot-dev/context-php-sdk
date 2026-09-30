<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandRetrieveParams\CountryGl;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\TickerExchange;
use ContextDev\Brand\BrandRetrieveParams\TimeoutOpts;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve logos, colors, company details, and social links using one lookup identifier. A direct URL limits extraction to that page.
 *
 * @see ContextDev\Services\BrandService::retrieve()
 *
 * @phpstan-import-type MccVariants from \ContextDev\Brand\BrandRetrieveParams\Mcc
 * @phpstan-import-type PhoneVariants from \ContextDev\Brand\BrandRetrieveParams\Phone
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Brand\BrandRetrieveParams\TimeoutOpts
 * @phpstan-import-type MccShape from \ContextDev\Brand\BrandRetrieveParams\Mcc
 * @phpstan-import-type PhoneShape from \ContextDev\Brand\BrandRetrieveParams\Phone
 *
 * @phpstan-type BrandRetrieveParamsShape = array{
 *   domain: string,
 *   type: Type|value-of<Type>,
 *   forceLanguage?: null|ForceLanguage|value-of<ForceLanguage>,
 *   maxAgeMs?: int|null,
 *   maxSpeed?: bool|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   name: string,
 *   countryGl?: null|CountryGl|value-of<CountryGl>,
 *   email: string,
 *   ticker: string,
 *   tickerExchange?: null|TickerExchange|value-of<TickerExchange>,
 *   directURL: string,
 *   transactionInfo: string,
 *   city?: string|null,
 *   highConfidenceOnly?: bool|null,
 *   mcc?: MccShape|null,
 *   phone?: PhoneShape|null,
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

    /**
     * Discriminator for transaction-based brand retrieval.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /** @var value-of<ForceLanguage>|null $forceLanguage */
    #[Optional('force_language', enum: ForceLanguage::class, nullable: true)]
    public ?string $forceLanguage;

    /**
     * Maximum age of cached brand data in ms. Defaults to 3 months; clamped to 0–1 year. `0` refreshes.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Optional parameter to optimize the API call for maximum speed. When set to true, the API will skip time-consuming operations for faster response at the cost of less comprehensive data.
     */
    #[Optional]
    public ?bool $maxSpeed;

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Company name to retrieve brand data for (e.g., 'Apple Inc').
     */
    #[Required]
    public string $name;

    /**
     * Two-letter ISO 3166-1 alpha-2 country code (GL parameter) used to localize search.
     *
     * @var value-of<CountryGl>|null $countryGl
     */
    #[Optional('country_gl', enum: CountryGl::class)]
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
     * Stock exchange code.
     *
     * @var value-of<TickerExchange>|null $tickerExchange
     */
    #[Optional('ticker_exchange', enum: TickerExchange::class)]
    public ?string $tickerExchange;

    /**
     * Full http(s) URL to fetch brand data from (e.g., 'https://stripe.com/enterprise'). Only this URL is fetched — not the entire internet.
     */
    #[Required('direct_url')]
    public string $directURL;

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
     *
     * @var MccVariants|null $mcc
     */
    #[Optional]
    public string|float|null $mcc;

    /**
     * Optional phone number from the transaction to help verify brand match.
     *
     * @var PhoneVariants|null $phone
     */
    #[Optional]
    public string|float|null $phone;

    /**
     * `new BrandRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandRetrieveParams::with(
     *   domain: ...,
     *   type: ...,
     *   name: ...,
     *   email: ...,
     *   ticker: ...,
     *   directURL: ...,
     *   transactionInfo: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandRetrieveParams)
     *   ->withDomain(...)
     *   ->withType(...)
     *   ->withName(...)
     *   ->withEmail(...)
     *   ->withTicker(...)
     *   ->withDirectURL(...)
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
     * @param Type|value-of<Type> $type
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param CountryGl|value-of<CountryGl>|null $countryGl
     * @param TickerExchange|value-of<TickerExchange>|null $tickerExchange
     * @param MccShape|null $mcc
     * @param PhoneShape|null $phone
     */
    public static function with(
        string $domain,
        Type|string $type,
        string $name,
        string $email,
        string $ticker,
        string $directURL,
        string $transactionInfo,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        CountryGl|string|null $countryGl = null,
        TickerExchange|string|null $tickerExchange = null,
        ?string $city = null,
        ?bool $highConfidenceOnly = null,
        string|float|null $mcc = null,
        string|float|null $phone = null,
    ): self {
        $self = new self;

        $self['domain'] = $domain;
        $self['type'] = $type;
        $self['name'] = $name;
        $self['email'] = $email;
        $self['ticker'] = $ticker;
        $self['directURL'] = $directURL;
        $self['transactionInfo'] = $transactionInfo;

        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxSpeed && $self['maxSpeed'] = $maxSpeed;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
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
     * Discriminator for transaction-based brand retrieval.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param ForceLanguage|value-of<ForceLanguage>|null $forceLanguage
     */
    public function withForceLanguage(
        ForceLanguage|string|null $forceLanguage
    ): self {
        $self = clone $this;
        $self['forceLanguage'] = $forceLanguage;

        return $self;
    }

    /**
     * Maximum age of cached brand data in ms. Defaults to 3 months; clamped to 0–1 year. `0` refreshes.
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
     * Labels for filtering usage in the dashboard.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

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
     * Two-letter ISO 3166-1 alpha-2 country code (GL parameter) used to localize search.
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
     * Stock exchange code.
     *
     * @param TickerExchange|value-of<TickerExchange> $tickerExchange
     */
    public function withTickerExchange(
        TickerExchange|string $tickerExchange
    ): self {
        $self = clone $this;
        $self['tickerExchange'] = $tickerExchange;

        return $self;
    }

    /**
     * Full http(s) URL to fetch brand data from (e.g., 'https://stripe.com/enterprise'). Only this URL is fetched — not the entire internet.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

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
     *
     * @param MccShape $mcc
     */
    public function withMcc(string|float $mcc): self
    {
        $self = clone $this;
        $self['mcc'] = $mcc;

        return $self;
    }

    /**
     * Optional phone number from the transaction to help verify brand match.
     *
     * @param PhoneShape $phone
     */
    public function withPhone(string|float $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
