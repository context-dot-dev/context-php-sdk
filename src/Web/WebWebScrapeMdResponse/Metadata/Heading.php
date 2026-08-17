<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdResponse\Metadata;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type HeadingShape = array{level: int, text: string}
 */
final class Heading implements BaseModel
{
    /** @use SdkModel<HeadingShape> */
    use SdkModel;

    /**
     * Heading level, 1–6 (from h1–h6).
     */
    #[Required]
    public int $level;

    /**
     * Heading text with whitespace collapsed, truncated to 1000 characters.
     */
    #[Required]
    public string $text;

    /**
     * `new Heading()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Heading::with(level: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Heading)->withLevel(...)->withText(...)
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
    public static function with(int $level, string $text): self
    {
        $self = new self;

        $self['level'] = $level;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Heading level, 1–6 (from h1–h6).
     */
    public function withLevel(int $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * Heading text with whitespace collapsed, truncated to 1000 characters.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
