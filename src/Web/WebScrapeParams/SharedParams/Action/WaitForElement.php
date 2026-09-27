<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Action;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type WaitForElementShape = array{selector: string, type: 'waitFor'}
 */
final class WaitForElement implements BaseModel
{
    /** @use SdkModel<WaitForElementShape> */
    use SdkModel;

    /**
     * Use `waitFor` to wait for a matching element.
     *
     * @var 'waitFor' $type
     */
    #[Required]
    public string $type = 'waitFor';

    /**
     * CSS selector to wait for before continuing.
     */
    #[Required]
    public string $selector;

    /**
     * `new WaitForElement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WaitForElement::with(selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WaitForElement)->withSelector(...)
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
     * CSS selector to wait for before continuing.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    /**
     * Use `waitFor` to wait for a matching element.
     *
     * @param 'waitFor' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
