<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Action;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type WaitShape = array{milliseconds: int, type: 'wait'}
 */
final class Wait implements BaseModel
{
    /** @use SdkModel<WaitShape> */
    use SdkModel;

    /** @var 'wait' $type */
    #[Required]
    public string $type = 'wait';

    #[Required]
    public int $milliseconds;

    /**
     * `new Wait()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Wait::with(milliseconds: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Wait)->withMilliseconds(...)
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
    public static function with(int $milliseconds): self
    {
        $self = new self;

        $self['milliseconds'] = $milliseconds;

        return $self;
    }

    public function withMilliseconds(int $milliseconds): self
    {
        $self = clone $this;
        $self['milliseconds'] = $milliseconds;

        return $self;
    }

    /**
     * @param 'wait' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
