<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\Typography\Headings;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type H3Shape = array{
 *   fontFallbacks: list<string>,
 *   fontFamily: string,
 *   fontSize: string,
 *   fontWeight: float,
 *   letterSpacing: string,
 *   lineHeight: string,
 * }
 */
final class H3 implements BaseModel
{
    /** @use SdkModel<H3Shape> */
    use SdkModel;

    /**
     * Full ordered font list from resolved computed font-family.
     *
     * @var list<string> $fontFallbacks
     */
    #[Required(list: 'string')]
    public array $fontFallbacks;

    /**
     * Primary face (first family in the computed stack).
     */
    #[Required]
    public string $fontFamily;

    #[Required]
    public string $fontSize;

    #[Required]
    public float $fontWeight;

    #[Required]
    public string $letterSpacing;

    #[Required]
    public string $lineHeight;

    /**
     * `new H3()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * H3::with(
     *   fontFallbacks: ...,
     *   fontFamily: ...,
     *   fontSize: ...,
     *   fontWeight: ...,
     *   letterSpacing: ...,
     *   lineHeight: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new H3)
     *   ->withFontFallbacks(...)
     *   ->withFontFamily(...)
     *   ->withFontSize(...)
     *   ->withFontWeight(...)
     *   ->withLetterSpacing(...)
     *   ->withLineHeight(...)
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
     * @param list<string> $fontFallbacks
     */
    public static function with(
        array $fontFallbacks,
        string $fontFamily,
        string $fontSize,
        float $fontWeight,
        string $letterSpacing,
        string $lineHeight,
    ): self {
        $self = new self;

        $self['fontFallbacks'] = $fontFallbacks;
        $self['fontFamily'] = $fontFamily;
        $self['fontSize'] = $fontSize;
        $self['fontWeight'] = $fontWeight;
        $self['letterSpacing'] = $letterSpacing;
        $self['lineHeight'] = $lineHeight;

        return $self;
    }

    /**
     * Full ordered font list from resolved computed font-family.
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
     * Primary face (first family in the computed stack).
     */
    public function withFontFamily(string $fontFamily): self
    {
        $self = clone $this;
        $self['fontFamily'] = $fontFamily;

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

    public function withLetterSpacing(string $letterSpacing): self
    {
        $self = clone $this;
        $self['letterSpacing'] = $letterSpacing;

        return $self;
    }

    public function withLineHeight(string $lineHeight): self
    {
        $self = clone $this;
        $self['lineHeight'] = $lineHeight;

        return $self;
    }
}
