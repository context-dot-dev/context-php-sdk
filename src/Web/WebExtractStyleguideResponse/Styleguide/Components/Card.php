<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Card component style.
 *
 * @phpstan-type CardShape = array{
 *   backgroundColor: string,
 *   borderColor: string,
 *   borderRadius: string,
 *   borderStyle: string,
 *   borderWidth: string,
 *   boxShadow: string,
 *   css: string,
 *   padding: string,
 *   textColor: string,
 * }
 */
final class Card implements BaseModel
{
    /** @use SdkModel<CardShape> */
    use SdkModel;

    #[Required]
    public string $backgroundColor;

    /**
     * Border color as CSS hex (#RRGGBB or #RRGGBBAA when computed border-color has alpha).
     */
    #[Required]
    public string $borderColor;

    #[Required]
    public string $borderRadius;

    #[Required]
    public string $borderStyle;

    #[Required]
    public string $borderWidth;

    #[Required]
    public string $boxShadow;

    /**
     * Ready-to-use CSS declaration block for this component style.
     */
    #[Required]
    public string $css;

    #[Required]
    public string $padding;

    #[Required]
    public string $textColor;

    /**
     * `new Card()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Card::with(
     *   backgroundColor: ...,
     *   borderColor: ...,
     *   borderRadius: ...,
     *   borderStyle: ...,
     *   borderWidth: ...,
     *   boxShadow: ...,
     *   css: ...,
     *   padding: ...,
     *   textColor: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Card)
     *   ->withBackgroundColor(...)
     *   ->withBorderColor(...)
     *   ->withBorderRadius(...)
     *   ->withBorderStyle(...)
     *   ->withBorderWidth(...)
     *   ->withBoxShadow(...)
     *   ->withCss(...)
     *   ->withPadding(...)
     *   ->withTextColor(...)
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
     */
    public static function with(
        string $backgroundColor,
        string $borderColor,
        string $borderRadius,
        string $borderStyle,
        string $borderWidth,
        string $boxShadow,
        string $css,
        string $padding,
        string $textColor,
    ): self {
        $self = new self;

        $self['backgroundColor'] = $backgroundColor;
        $self['borderColor'] = $borderColor;
        $self['borderRadius'] = $borderRadius;
        $self['borderStyle'] = $borderStyle;
        $self['borderWidth'] = $borderWidth;
        $self['boxShadow'] = $boxShadow;
        $self['css'] = $css;
        $self['padding'] = $padding;
        $self['textColor'] = $textColor;

        return $self;
    }

    public function withBackgroundColor(string $backgroundColor): self
    {
        $self = clone $this;
        $self['backgroundColor'] = $backgroundColor;

        return $self;
    }

    /**
     * Border color as CSS hex (#RRGGBB or #RRGGBBAA when computed border-color has alpha).
     */
    public function withBorderColor(string $borderColor): self
    {
        $self = clone $this;
        $self['borderColor'] = $borderColor;

        return $self;
    }

    public function withBorderRadius(string $borderRadius): self
    {
        $self = clone $this;
        $self['borderRadius'] = $borderRadius;

        return $self;
    }

    public function withBorderStyle(string $borderStyle): self
    {
        $self = clone $this;
        $self['borderStyle'] = $borderStyle;

        return $self;
    }

    public function withBorderWidth(string $borderWidth): self
    {
        $self = clone $this;
        $self['borderWidth'] = $borderWidth;

        return $self;
    }

    public function withBoxShadow(string $boxShadow): self
    {
        $self = clone $this;
        $self['boxShadow'] = $boxShadow;

        return $self;
    }

    /**
     * Ready-to-use CSS declaration block for this component style.
     */
    public function withCss(string $css): self
    {
        $self = clone $this;
        $self['css'] = $css;

        return $self;
    }

    public function withPadding(string $padding): self
    {
        $self = clone $this;
        $self['padding'] = $padding;

        return $self;
    }

    public function withTextColor(string $textColor): self
    {
        $self = clone $this;
        $self['textColor'] = $textColor;

        return $self;
    }
}
