<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Card;

/**
 * UI component styles.
 *
 * @phpstan-import-type ButtonShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button
 * @phpstan-import-type CardShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Card
 *
 * @phpstan-type ComponentsShape = array{
 *   button: Button|ButtonShape, card?: null|Card|CardShape
 * }
 */
final class Components implements BaseModel
{
    /** @use SdkModel<ComponentsShape> */
    use SdkModel;

    /**
     * Button component styles.
     */
    #[Required]
    public Button $button;

    /**
     * Card component style.
     */
    #[Optional]
    public ?Card $card;

    /**
     * `new Components()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Components::with(button: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Components)->withButton(...)
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
     * @param Button|ButtonShape $button
     * @param Card|CardShape|null $card
     */
    public static function with(
        Button|array $button,
        Card|array|null $card = null
    ): self {
        $self = new self;

        $self['button'] = $button;

        null !== $card && $self['card'] = $card;

        return $self;
    }

    /**
     * Button component styles.
     *
     * @param Button|ButtonShape $button
     */
    public function withButton(Button|array $button): self
    {
        $self = clone $this;
        $self['button'] = $button;

        return $self;
    }

    /**
     * Card component style.
     *
     * @param Card|CardShape $card
     */
    public function withCard(Card|array $card): self
    {
        $self = clone $this;
        $self['card'] = $card;

        return $self;
    }
}
