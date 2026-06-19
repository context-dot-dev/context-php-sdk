<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components\Button;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type LinkShape = array{
 *   backgroundColor: string,
 *   borderColor: string,
 *   borderRadius: string,
 *   borderStyle: string,
 *   borderWidth: string,
 *   boxShadow: string,
 *   color: string,
 *   css: string,
 *   fontSize: string,
 *   fontWeight: float,
 *   minHeight: string,
 *   minWidth: string,
 *   padding: string,
 *   textDecoration: string,
 *   fontFallbacks?: list<string>|null,
 *   fontFamily?: string|null,
 *   textDecorationColor?: string|null,
 * }
 */
final class Link implements BaseModel
{
    /** @use SdkModel<LinkShape> */
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

    /**
     * Computed box-shadow (comma-separated layers when present).
     */
    #[Required]
    public string $boxShadow;

    #[Required]
    public string $color;

    /**
     * Ready-to-use CSS declaration block for this component style.
     */
    #[Required]
    public string $css;

    #[Required]
    public string $fontSize;

    #[Required]
    public float $fontWeight;

    /**
     * Sampled minimum height of the button box (typically px).
     */
    #[Required]
    public string $minHeight;

    /**
     * Sampled minimum width of the button box (typically px).
     */
    #[Required]
    public string $minWidth;

    #[Required]
    public string $padding;

    #[Required]
    public string $textDecoration;

    /**
     * Full ordered font list from computed font-family.
     *
     * @var list<string>|null $fontFallbacks
     */
    #[Optional(list: 'string')]
    public ?array $fontFallbacks;

    /**
     * Primary button typeface (first in fontFallbacks).
     */
    #[Optional]
    public ?string $fontFamily;

    /**
     * Hex color of the underline when it differs from the text color.
     */
    #[Optional]
    public ?string $textDecorationColor;

    /**
     * `new Link()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Link::with(
     *   backgroundColor: ...,
     *   borderColor: ...,
     *   borderRadius: ...,
     *   borderStyle: ...,
     *   borderWidth: ...,
     *   boxShadow: ...,
     *   color: ...,
     *   css: ...,
     *   fontSize: ...,
     *   fontWeight: ...,
     *   minHeight: ...,
     *   minWidth: ...,
     *   padding: ...,
     *   textDecoration: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Link)
     *   ->withBackgroundColor(...)
     *   ->withBorderColor(...)
     *   ->withBorderRadius(...)
     *   ->withBorderStyle(...)
     *   ->withBorderWidth(...)
     *   ->withBoxShadow(...)
     *   ->withColor(...)
     *   ->withCss(...)
     *   ->withFontSize(...)
     *   ->withFontWeight(...)
     *   ->withMinHeight(...)
     *   ->withMinWidth(...)
     *   ->withPadding(...)
     *   ->withTextDecoration(...)
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
     * @param list<string>|null $fontFallbacks
     */
    public static function with(
        string $backgroundColor,
        string $borderColor,
        string $borderRadius,
        string $borderStyle,
        string $borderWidth,
        string $boxShadow,
        string $color,
        string $css,
        string $fontSize,
        float $fontWeight,
        string $minHeight,
        string $minWidth,
        string $padding,
        string $textDecoration,
        ?array $fontFallbacks = null,
        ?string $fontFamily = null,
        ?string $textDecorationColor = null,
    ): self {
        $self = new self;

        $self['backgroundColor'] = $backgroundColor;
        $self['borderColor'] = $borderColor;
        $self['borderRadius'] = $borderRadius;
        $self['borderStyle'] = $borderStyle;
        $self['borderWidth'] = $borderWidth;
        $self['boxShadow'] = $boxShadow;
        $self['color'] = $color;
        $self['css'] = $css;
        $self['fontSize'] = $fontSize;
        $self['fontWeight'] = $fontWeight;
        $self['minHeight'] = $minHeight;
        $self['minWidth'] = $minWidth;
        $self['padding'] = $padding;
        $self['textDecoration'] = $textDecoration;

        null !== $fontFallbacks && $self['fontFallbacks'] = $fontFallbacks;
        null !== $fontFamily && $self['fontFamily'] = $fontFamily;
        null !== $textDecorationColor && $self['textDecorationColor'] = $textDecorationColor;

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

    /**
     * Computed box-shadow (comma-separated layers when present).
     */
    public function withBoxShadow(string $boxShadow): self
    {
        $self = clone $this;
        $self['boxShadow'] = $boxShadow;

        return $self;
    }

    public function withColor(string $color): self
    {
        $self = clone $this;
        $self['color'] = $color;

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

    public function withFontSize(string $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
    }

    public function withFontWeight(float $fontWeight): self
    {
        $self = clone $this;
        $self['fontWeight'] = $fontWeight;

        return $self;
    }

    /**
     * Sampled minimum height of the button box (typically px).
     */
    public function withMinHeight(string $minHeight): self
    {
        $self = clone $this;
        $self['minHeight'] = $minHeight;

        return $self;
    }

    /**
     * Sampled minimum width of the button box (typically px).
     */
    public function withMinWidth(string $minWidth): self
    {
        $self = clone $this;
        $self['minWidth'] = $minWidth;

        return $self;
    }

    public function withPadding(string $padding): self
    {
        $self = clone $this;
        $self['padding'] = $padding;

        return $self;
    }

    public function withTextDecoration(string $textDecoration): self
    {
        $self = clone $this;
        $self['textDecoration'] = $textDecoration;

        return $self;
    }

    /**
     * Full ordered font list from computed font-family.
     *
     * @param list<string> $fontFallbacks
     */
    public function withFontFallbacks(array $fontFallbacks): self
    {
        $self = clone $this;
        $self['fontFallbacks'] = $fontFallbacks;

        return $self;
    }

    /**
     * Primary button typeface (first in fontFallbacks).
     */
    public function withFontFamily(string $fontFamily): self
    {
        $self = clone $this;
        $self['fontFamily'] = $fontFamily;

        return $self;
    }

    /**
     * Hex color of the underline when it differs from the text color.
     */
    public function withTextDecorationColor(string $textDecorationColor): self
    {
        $self = clone $this;
        $self['textDecorationColor'] = $textDecorationColor;

        return $self;
    }
}
