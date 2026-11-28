<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandRetrieveParams\Country;
use ContextDev\Brand\BrandRetrieveParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveParams\TickerExchange;
use ContextDev\Brand\BrandRetrieveParams\TimeoutOpts;
use ContextDev\Brand\BrandRetrieveParams\Type;
use ContextDev\Brand\BrandRetrieveParams\Zdr;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Look up a brand by domain, company name, work email, stock ticker, page URL, or card transaction descriptor. Returns logos, colors, backdrops, description, industries, address, stock listing, and social links. A `by_direct_url` lookup reads only that page.
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
 *   policies?: list<string>|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 *   name: string,
 *   country?: null|Country|value-of<Country>,
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
     * Domain of the brand, such as `stripe.com`.
     */
    #[Required]
    public string $domain;

    /**
     * Set to `by_transaction` to identify the merchant behind a transaction descriptor.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Translate the brand's `title`, `description`, and `slogan` into this language.
     *
     * @var value-of<ForceLanguage>|null $forceLanguage
     */
    #[Optional('force_language', enum: ForceLanguage::class, nullable: true)]
    public ?string $forceLanguage;

    /**
     * Maximum age of cached brand data, in milliseconds. `0` always fetches fresh. Defaults to 90 days (7776000000 ms). Values above 1 year (31536000000 ms) are capped at 1 year.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Skip slower enrichment steps for a faster, less detailed response.
     */
    #[Optional]
    public ?bool $maxSpeed;

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * Company name, such as `Apple Inc`.
     */
    #[Required]
    public string $name;

    /**
     * Lowercase ISO 3166-1 alpha-2 country code, such as `us`.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Work email address, such as `jane@stripe.com`. The brand is looked up from its domain.
     */
    #[Required]
    public string $email;

    /**
     * Stock ticker symbol, such as `AAPL`.
     */
    #[Required]
    public string $ticker;

    /**
     * Stock exchange code, such as `NASDAQ` or `LSE`.
     *
     * @var value-of<TickerExchange>|null $tickerExchange
     */
    #[Optional('ticker_exchange', enum: TickerExchange::class)]
    public ?string $tickerExchange;

    /**
     * Full `http` or `https` URL of the page to read, such as `https://stripe.com/enterprise`. Only this page is fetched.
     */
    #[Required('direct_url')]
    public string $directURL;

    /**
     * Transaction descriptor from a card or bank statement, such as `SQ *COFFEE SHOP`.
     */
    #[Required('transaction_info')]
    public string $transactionInfo;

    /**
     * City where the transaction took place. Brands in this city are preferred.
     */
    #[Optional]
    public ?string $city;

    /**
     * Run extra verification so the returned brand matches the transaction with high confidence.
     */
    #[Optional('high_confidence_only')]
    public ?bool $highConfidenceOnly;

    /**
     * Merchant Category Code (MCC) from the transaction. Helps identify the type of business.
     *
     * @var MccVariants|null $mcc
     */
    #[Optional]
    public string|float|null $mcc;

    /**
     * Merchant phone number from the transaction. Helps confirm the match.
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
     * @param list<string>|null $policies
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     * @param Country|value-of<Country>|null $country
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
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
        Country|string|null $country = null,
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
        null !== $policies && $self['policies'] = $policies;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;
        null !== $country && $self['country'] = $country;
        null !== $tickerExchange && $self['tickerExchange'] = $tickerExchange;
        null !== $city && $self['city'] = $city;
        null !== $highConfidenceOnly && $self['highConfidenceOnly'] = $highConfidenceOnly;
        null !== $mcc && $self['mcc'] = $mcc;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * Domain of the brand, such as `stripe.com`.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Set to `by_transaction` to identify the merchant behind a transaction descriptor.
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
     * Translate the brand's `title`, `description`, and `slogan` into this language.
     *
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
     * Maximum age of cached brand data, in milliseconds. `0` always fetches fresh. Defaults to 90 days (7776000000 ms). Values above 1 year (31536000000 ms) are capped at 1 year.
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Skip slower enrichment steps for a faster, less detailed response.
     */
    public function withMaxSpeed(bool $maxSpeed): self
    {
        $self = clone $this;
        $self['maxSpeed'] = $maxSpeed;

        return $self;
    }

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Company name, such as `Apple Inc`.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Lowercase ISO 3166-1 alpha-2 country code, such as `us`.
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Work email address, such as `jane@stripe.com`. The brand is looked up from its domain.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Stock ticker symbol, such as `AAPL`.
     */
    public function withTicker(string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }

    /**
     * Stock exchange code, such as `NASDAQ` or `LSE`.
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
     * Full `http` or `https` URL of the page to read, such as `https://stripe.com/enterprise`. Only this page is fetched.
     */
    public function withDirectURL(string $directURL): self
    {
        $self = clone $this;
        $self['directURL'] = $directURL;

        return $self;
    }

    /**
     * Transaction descriptor from a card or bank statement, such as `SQ *COFFEE SHOP`.
     */
    public function withTransactionInfo(string $transactionInfo): self
    {
        $self = clone $this;
        $self['transactionInfo'] = $transactionInfo;

        return $self;
    }

    /**
     * City where the transaction took place. Brands in this city are preferred.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Run extra verification so the returned brand matches the transaction with high confidence.
     */
    public function withHighConfidenceOnly(bool $highConfidenceOnly): self
    {
        $self = clone $this;
        $self['highConfidenceOnly'] = $highConfidenceOnly;

        return $self;
    }

    /**
     * Merchant Category Code (MCC) from the transaction. Helps identify the type of business.
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
     * Merchant phone number from the transaction. Helps confirm the match.
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
