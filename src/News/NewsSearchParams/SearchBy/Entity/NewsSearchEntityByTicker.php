<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy\Entity;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\SearchBy\Entity\NewsSearchEntityByTicker\Exchange;

/**
 * Identify the company by stock ticker, optionally scoped to an exchange.
 *
 * @phpstan-type NewsSearchEntityByTickerShape = array{
 *   ticker: string, type: 'ticker', exchange?: null|Exchange|value-of<Exchange>
 * }
 */
final class NewsSearchEntityByTicker implements BaseModel
{
    /** @use SdkModel<NewsSearchEntityByTickerShape> */
    use SdkModel;

    /** @var 'ticker' $type */
    #[Required]
    public string $type = 'ticker';

    /**
     * Public-company ticker.
     */
    #[Required]
    public string $ticker;

    /**
     * Stock exchange the ticker trades on, used to disambiguate tickers listed on multiple exchanges.
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
     * Public-company ticker.
     */
    public function withTicker(string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }

    /**
     * @param 'ticker' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Stock exchange the ticker trades on, used to disambiguate tickers listed on multiple exchanges.
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
