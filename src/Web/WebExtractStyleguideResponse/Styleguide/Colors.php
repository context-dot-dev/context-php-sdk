<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Primary colors used on the website.
 *
 * @phpstan-type ColorsShape = array{
 *   accent: string, background: string, text: string
 * }
 */
final class Colors implements BaseModel
{
    /** @use SdkModel<ColorsShape> */
    use SdkModel;

    /**
     * Accent color (hex format).
     */
    #[Required]
    public string $accent;

    /**
     * Background color (hex format).
     */
    #[Required]
    public string $background;

    /**
     * Text color (hex format).
     */
    #[Required]
    public string $text;

    /**
     * `new Colors()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Colors::with(accent: ..., background: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Colors)->withAccent(...)->withBackground(...)->withText(...)
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
        string $accent,
        string $background,
        string $text
    ): self {
        $self = new self;

        $self['accent'] = $accent;
        $self['background'] = $background;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Accent color (hex format).
     */
    public function withAccent(string $accent): self
    {
        $self = clone $this;
        $self['accent'] = $accent;

        return $self;
    }

    /**
     * Background color (hex format).
     */
    public function withBackground(string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    /**
     * Text color (hex format).
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
