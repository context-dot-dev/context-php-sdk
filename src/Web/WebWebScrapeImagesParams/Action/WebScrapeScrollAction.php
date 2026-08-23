<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesParams\Action;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesParams\Action\WebScrapeScrollAction\Amount;
use ContextDev\Web\WebWebScrapeImagesParams\Action\WebScrapeScrollAction\Amount\UnionMember1;
use ContextDev\Web\WebWebScrapeImagesParams\Action\WebScrapeScrollAction\Direction;

/**
 * Scroll the page or a selected scrollable container, waiting adaptively for content and dimensions to settle after each iteration.
 *
 * @phpstan-import-type AmountVariants from \ContextDev\Web\WebWebScrapeImagesParams\Action\WebScrapeScrollAction\Amount
 * @phpstan-import-type AmountShape from \ContextDev\Web\WebWebScrapeImagesParams\Action\WebScrapeScrollAction\Amount
 *
 * @phpstan-type WebScrapeScrollActionShape = array{
 *   do: 'scroll',
 *   amount?: AmountShape|null,
 *   container?: string|null,
 *   direction?: null|Direction|value-of<Direction>,
 *   maxScrolls?: int|null,
 * }
 */
final class WebScrapeScrollAction implements BaseModel
{
    /** @use SdkModel<WebScrapeScrollActionShape> */
    use SdkModel;

    /** @var 'scroll' $do */
    #[Required]
    public string $do = 'scroll';

    /**
     * Pixels per scroll, one visible viewport, or the current scroll boundary. Defaults to viewport.
     *
     * @var AmountVariants|null $amount
     */
    #[Optional(union: Amount::class)]
    public int|string|null $amount;

    /**
     * CSS selector for the first matching scroll container. Defaults to the page.
     */
    #[Optional]
    public ?string $container;

    /**
     * Direction to scroll. Defaults to down.
     *
     * @var value-of<Direction>|null $direction
     */
    #[Optional(enum: Direction::class)]
    public ?string $direction;

    /**
     * Maximum scroll iterations. Stops early when scrolling and scrollable extent stop changing. Defaults to 1.
     */
    #[Optional]
    public ?int $maxScrolls;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AmountShape|null $amount
     * @param Direction|value-of<Direction>|null $direction
     */
    public static function with(
        int|UnionMember1|string|null $amount = null,
        ?string $container = null,
        Direction|string|null $direction = null,
        ?int $maxScrolls = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $container && $self['container'] = $container;
        null !== $direction && $self['direction'] = $direction;
        null !== $maxScrolls && $self['maxScrolls'] = $maxScrolls;

        return $self;
    }

    /**
     * @param 'scroll' $do
     */
    public function withDo(string $do): self
    {
        $self = clone $this;
        $self['do'] = $do;

        return $self;
    }

    /**
     * Pixels per scroll, one visible viewport, or the current scroll boundary. Defaults to viewport.
     *
     * @param AmountShape $amount
     */
    public function withAmount(int|UnionMember1|string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * CSS selector for the first matching scroll container. Defaults to the page.
     */
    public function withContainer(string $container): self
    {
        $self = clone $this;
        $self['container'] = $container;

        return $self;
    }

    /**
     * Direction to scroll. Defaults to down.
     *
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * Maximum scroll iterations. Stops early when scrolling and scrollable extent stop changing. Defaults to 1.
     */
    public function withMaxScrolls(int $maxScrolls): self
    {
        $self = clone $this;
        $self['maxScrolls'] = $maxScrolls;

        return $self;
    }
}
