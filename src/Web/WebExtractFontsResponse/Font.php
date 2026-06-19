<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractFontsResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type FontShape = array{
 *   fallbacks: list<string>,
 *   font: string,
 *   numElements: float,
 *   numWords: float,
 *   percentElements: float,
 *   percentWords: float,
 *   uses: list<string>,
 * }
 */
final class Font implements BaseModel
{
    /** @use SdkModel<FontShape> */
    use SdkModel;

    /**
     * Array of fallback font families.
     *
     * @var list<string> $fallbacks
     */
    #[Required(list: 'string')]
    public array $fallbacks;

    /**
     * Font family name.
     */
    #[Required]
    public string $font;

    /**
     * Number of elements using this font.
     */
    #[Required('num_elements')]
    public float $numElements;

    /**
     * Number of words using this font.
     */
    #[Required('num_words')]
    public float $numWords;

    /**
     * Percentage of elements using this font.
     */
    #[Required('percent_elements')]
    public float $percentElements;

    /**
     * Percentage of words using this font.
     */
    #[Required('percent_words')]
    public float $percentWords;

    /**
     * Array of CSS selectors or element types where this font is used.
     *
     * @var list<string> $uses
     */
    #[Required(list: 'string')]
    public array $uses;

    /**
     * `new Font()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Font::with(
     *   fallbacks: ...,
     *   font: ...,
     *   numElements: ...,
     *   numWords: ...,
     *   percentElements: ...,
     *   percentWords: ...,
     *   uses: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Font)
     *   ->withFallbacks(...)
     *   ->withFont(...)
     *   ->withNumElements(...)
     *   ->withNumWords(...)
     *   ->withPercentElements(...)
     *   ->withPercentWords(...)
     *   ->withUses(...)
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
     * @param list<string> $fallbacks
     * @param list<string> $uses
     */
    public static function with(
        array $fallbacks,
        string $font,
        float $numElements,
        float $numWords,
        float $percentElements,
        float $percentWords,
        array $uses,
    ): self {
        $self = new self;

        $self['fallbacks'] = $fallbacks;
        $self['font'] = $font;
        $self['numElements'] = $numElements;
        $self['numWords'] = $numWords;
        $self['percentElements'] = $percentElements;
        $self['percentWords'] = $percentWords;
        $self['uses'] = $uses;

        return $self;
    }

    /**
     * Array of fallback font families.
     *
     * @param list<string> $fallbacks
     */
    public function withFallbacks(array $fallbacks): self
    {
        $self = clone $this;
        $self['fallbacks'] = $fallbacks;

        return $self;
    }

    /**
     * Font family name.
     */
    public function withFont(string $font): self
    {
        $self = clone $this;
        $self['font'] = $font;

        return $self;
    }

    /**
     * Number of elements using this font.
     */
    public function withNumElements(float $numElements): self
    {
        $self = clone $this;
        $self['numElements'] = $numElements;

        return $self;
    }

    /**
     * Number of words using this font.
     */
    public function withNumWords(float $numWords): self
    {
        $self = clone $this;
        $self['numWords'] = $numWords;

        return $self;
    }

    /**
     * Percentage of elements using this font.
     */
    public function withPercentElements(float $percentElements): self
    {
        $self = clone $this;
        $self['percentElements'] = $percentElements;

        return $self;
    }

    /**
     * Percentage of words using this font.
     */
    public function withPercentWords(float $percentWords): self
    {
        $self = clone $this;
        $self['percentWords'] = $percentWords;

        return $self;
    }

    /**
     * Array of CSS selectors or element types where this font is used.
     *
     * @param list<string> $uses
     */
    public function withUses(array $uses): self
    {
        $self = clone $this;
        $self['uses'] = $uses;

        return $self;
    }
}
