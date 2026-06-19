<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandRetrieveByTickerParams\ForceLanguage;
use ContextDev\Brand\BrandRetrieveByTickerParams\TickerExchange;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve brand information using a stock ticker symbol.
 *
 * @see ContextDev\Services\BrandService::retrieveByTicker()
 *
 * @phpstan-type BrandRetrieveByTickerParamsShape = array{
 *   ticker: string,
 *   forceLanguage?: null|ForceLanguage|value-of<ForceLanguage>,
 *   maxAgeMs?: int|null,
 *   maxSpeed?: bool|null,
 *   tickerExchange?: null|TickerExchange|value-of<TickerExchange>,
 *   timeoutMs?: int|null,
 * }
 */
final class BrandRetrieveByTickerParams implements BaseModel
{
    /** @use SdkModel<BrandRetrieveByTickerParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Stock ticker symbol to retrieve brand data for (e.g., 'AAPL', 'GOOGL', 'BRK.A'). Must be 1-15 characters, letters/numbers/dots only.
     */
    #[Required]
    public string $ticker;

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
     * Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
     *
     * @var value-of<TickerExchange>|null $tickerExchange
     */
    #[Optional(enum: TickerExchange::class)]
    public ?string $tickerExchange;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * `new BrandRetrieveByTickerParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandRetrieveByTickerParams::with(ticker: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandRetrieveByTickerParams)->withTicker(...)
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
     * @param TickerExchange|value-of<TickerExchange>|null $tickerExchange
     */
    public static function with(
        string $ticker,
        ForceLanguage|string|null $forceLanguage = null,
        ?int $maxAgeMs = null,
        ?bool $maxSpeed = null,
        TickerExchange|string|null $tickerExchange = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['ticker'] = $ticker;

        null !== $forceLanguage && $self['forceLanguage'] = $forceLanguage;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxSpeed && $self['maxSpeed'] = $maxSpeed;
        null !== $tickerExchange && $self['tickerExchange'] = $tickerExchange;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Stock ticker symbol to retrieve brand data for (e.g., 'AAPL', 'GOOGL', 'BRK.A'). Must be 1-15 characters, letters/numbers/dots only.
     */
    public function withTicker(string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

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
     * Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
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
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
