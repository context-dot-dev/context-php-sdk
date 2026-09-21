<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Action;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll\Amount;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll\Amount\UnionMember1;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll\Direction;

/**
 * @phpstan-import-type AmountVariants from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll\Amount
 * @phpstan-import-type AmountShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll\Amount
 *
 * @phpstan-type ScrollShape = array{
 *   type: 'scroll',
 *   amount?: AmountShape|null,
 *   direction?: null|Direction|value-of<Direction>,
 *   maxScrolls?: int|null,
 *   selector?: string|null,
 * }
 */
final class Scroll implements BaseModel
{
    /** @use SdkModel<ScrollShape> */
    use SdkModel;

    /** @var 'scroll' $type */
    #[Required]
    public string $type = 'scroll';

    /** @var AmountVariants|null $amount */
    #[Optional(union: Amount::class)]
    public int|string|null $amount;

    /** @var value-of<Direction>|null $direction */
    #[Optional(enum: Direction::class)]
    public ?string $direction;

    #[Optional]
    public ?int $maxScrolls;

    /**
     * Scroll this container. Omit to scroll the page.
     */
    #[Optional]
    public ?string $selector;

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
        Direction|string|null $direction = null,
        ?int $maxScrolls = null,
        ?string $selector = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $direction && $self['direction'] = $direction;
        null !== $maxScrolls && $self['maxScrolls'] = $maxScrolls;
        null !== $selector && $self['selector'] = $selector;

        return $self;
    }

    /**
     * @param 'scroll' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param AmountShape $amount
     */
    public function withAmount(int|UnionMember1|string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    public function withMaxScrolls(int $maxScrolls): self
    {
        $self = clone $this;
        $self['maxScrolls'] = $maxScrolls;

        return $self;
    }

    /**
     * Scroll this container. Omit to scroll the page.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }
}
