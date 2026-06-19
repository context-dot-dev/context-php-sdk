<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandIdentifyFromTransactionResponse\Brand;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Stock market information for this brand (will be null if not a publicly traded company).
 *
 * @phpstan-type StockShape = array{exchange?: string|null, ticker?: string|null}
 */
final class Stock implements BaseModel
{
    /** @use SdkModel<StockShape> */
    use SdkModel;

    /**
     * Stock exchange name.
     */
    #[Optional]
    public ?string $exchange;

    /**
     * Stock ticker symbol.
     */
    #[Optional]
    public ?string $ticker;

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
        ?string $exchange = null,
        ?string $ticker = null
    ): self {
        $self = new self;

        null !== $exchange && $self['exchange'] = $exchange;
        null !== $ticker && $self['ticker'] = $ticker;

        return $self;
    }

    /**
     * Stock exchange name.
     */
    public function withExchange(string $exchange): self
    {
        $self = clone $this;
        $self['exchange'] = $exchange;

        return $self;
    }

    /**
     * Stock ticker symbol.
     */
    public function withTicker(string $ticker): self
    {
        $self = clone $this;
        $self['ticker'] = $ticker;

        return $self;
    }
}
