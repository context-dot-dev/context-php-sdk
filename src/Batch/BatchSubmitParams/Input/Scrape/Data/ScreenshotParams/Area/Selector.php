<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\ScreenshotParams\Area;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type SelectorShape = array{selector: string}
 */
final class Selector implements BaseModel
{
    /** @use SdkModel<SelectorShape> */
    use SdkModel;

    /**
     * CSS selector matching exactly one visible element.
     */
    #[Required]
    public string $selector;

    /**
     * `new Selector()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Selector::with(selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Selector)->withSelector(...)
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
    public static function with(string $selector): self
    {
        $self = new self;

        $self['selector'] = $selector;

        return $self;
    }

    /**
     * CSS selector matching exactly one visible element.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }
}
