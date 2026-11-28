<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByTicker\Exchange;

/**
 * Identify the company by stock ticker, optionally on a specific exchange.
 *
 * @phpstan-type NewsSearchEntityByTickerShape = array{
 *   ticker: string, type: 'ticker', exchange?: null|Exchange|value-of<Exchange>
 * }
 */
final class NewsSearchEntityByTicker implements BaseModel
{
    /** @use SdkModel<NewsSearchEntityByTickerShape> */
    use SdkModel;

    /**
     * Set to `ticker` to identify a publicly traded company.
     *
     * @var 'ticker' $type
     */
    #[Required]
    public string $type = 'ticker';

    /**
     * Stock ticker symbol, such as `AAPL`.
     */
    #[Required]
    public string $ticker;

    /**
     * Exchange the ticker trades on. Use it when the same ticker is listed on more than one exchange.
     *
     * @var value-of<Exchange>|null $exchange
     */
    #[Optional(enum: Exchange::class)]
    public ?string $exchange;

    /**
     * `new NewsSearchEntityByTicker()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchEntityByTicker::with(ticker: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchEntityByTicker)->withTicker(...)
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
     * @param Exchange|value-of<Exchange>|null $exchange
     */
    public static function with(
        string $ticker,
        Exchange|string|null $exchange = null
    ): self {
        $self = new self;

        $self['ticker'] = $ticker;

        null !== $exchange && $self['exchange'] = $exchange;

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
     * Set to `ticker` to identify a publicly traded company.
     *
     * @param 'ticker' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Exchange the ticker trades on. Use it when the same ticker is listed on more than one exchange.
     *
     * @param Exchange|value-of<Exchange> $exchange
     */
    public function withExchange(Exchange|string $exchange): self
    {
        $self = clone $this;
        $self['exchange'] = $exchange;

        return $self;
    }
}
