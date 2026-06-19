<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Colors;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\ElementSpacing;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Mode;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Shadows;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography;

/**
 * Comprehensive styleguide data extracted from the website.
 *
 * @phpstan-import-type ColorsShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Colors
 * @phpstan-import-type ComponentsShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Components
 * @phpstan-import-type ElementSpacingShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\ElementSpacing
 * @phpstan-import-type FontLinkShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink
 * @phpstan-import-type ShadowsShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Shadows
 * @phpstan-import-type TypographyShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography
 *
 * @phpstan-type StyleguideShape = array{
 *   colors: Colors|ColorsShape,
 *   components: Components|ComponentsShape,
 *   elementSpacing: ElementSpacing|ElementSpacingShape,
 *   fontLinks: array<string,FontLink|FontLinkShape>,
 *   mode: Mode|value-of<Mode>,
 *   shadows: Shadows|ShadowsShape,
 *   typography: Typography|TypographyShape,
 * }
 */
final class Styleguide implements BaseModel
{
    /** @use SdkModel<StyleguideShape> */
    use SdkModel;

    /**
     * Primary colors used on the website.
     */
    #[Required]
    public Colors $colors;

    /**
     * UI component styles.
     */
    #[Required]
    public Components $components;

    /**
     * Spacing system used on the website.
     */
    #[Required]
    public ElementSpacing $elementSpacing;

    /**
     * Font assets keyed by family name as it appears in fontFamily/fontFallbacks (non-generic names only). Clients match typography.fontFamily / fontWeight or button styles to pick a file URL from files.
     *
     * @var array<string,FontLink> $fontLinks
     */
    #[Required(map: FontLink::class)]
    public array $fontLinks;

    /**
     * The primary color mode of the website design.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Shadow styles used on the website.
     */
    #[Required]
    public Shadows $shadows;

    /**
     * Typography styles used on the website.
     */
    #[Required]
    public Typography $typography;

    /**
     * `new Styleguide()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Styleguide::with(
     *   colors: ...,
     *   components: ...,
     *   elementSpacing: ...,
     *   fontLinks: ...,
     *   mode: ...,
     *   shadows: ...,
     *   typography: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Styleguide)
     *   ->withColors(...)
     *   ->withComponents(...)
     *   ->withElementSpacing(...)
     *   ->withFontLinks(...)
     *   ->withMode(...)
     *   ->withShadows(...)
     *   ->withTypography(...)
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
     * @param Colors|ColorsShape $colors
     * @param Components|ComponentsShape $components
     * @param ElementSpacing|ElementSpacingShape $elementSpacing
     * @param array<string,FontLink|FontLinkShape> $fontLinks
     * @param Mode|value-of<Mode> $mode
     * @param Shadows|ShadowsShape $shadows
     * @param Typography|TypographyShape $typography
     */
    public static function with(
        Colors|array $colors,
        Components|array $components,
        ElementSpacing|array $elementSpacing,
        array $fontLinks,
        Mode|string $mode,
        Shadows|array $shadows,
        Typography|array $typography,
    ): self {
        $self = new self;

        $self['colors'] = $colors;
        $self['components'] = $components;
        $self['elementSpacing'] = $elementSpacing;
        $self['fontLinks'] = $fontLinks;
        $self['mode'] = $mode;
        $self['shadows'] = $shadows;
        $self['typography'] = $typography;

        return $self;
    }

    /**
     * Primary colors used on the website.
     *
     * @param Colors|ColorsShape $colors
     */
    public function withColors(Colors|array $colors): self
    {
        $self = clone $this;
        $self['colors'] = $colors;

        return $self;
    }

    /**
     * UI component styles.
     *
     * @param Components|ComponentsShape $components
     */
    public function withComponents(Components|array $components): self
    {
        $self = clone $this;
        $self['components'] = $components;

        return $self;
    }

    /**
     * Spacing system used on the website.
     *
     * @param ElementSpacing|ElementSpacingShape $elementSpacing
     */
    public function withElementSpacing(
        ElementSpacing|array $elementSpacing
    ): self {
        $self = clone $this;
        $self['elementSpacing'] = $elementSpacing;

        return $self;
    }

    /**
     * Font assets keyed by family name as it appears in fontFamily/fontFallbacks (non-generic names only). Clients match typography.fontFamily / fontWeight or button styles to pick a file URL from files.
     *
     * @param array<string,FontLink|FontLinkShape> $fontLinks
     */
    public function withFontLinks(array $fontLinks): self
    {
        $self = clone $this;
        $self['fontLinks'] = $fontLinks;

        return $self;
    }

    /**
     * The primary color mode of the website design.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Shadow styles used on the website.
     *
     * @param Shadows|ShadowsShape $shadows
     */
    public function withShadows(Shadows|array $shadows): self
    {
        $self = clone $this;
        $self['shadows'] = $shadows;

        return $self;
    }

    /**
     * Typography styles used on the website.
     *
     * @param Typography|TypographyShape $typography
     */
    public function withTypography(Typography|array $typography): self
    {
        $self = clone $this;
        $self['typography'] = $typography;

        return $self;
    }
}
