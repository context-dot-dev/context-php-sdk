<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Action;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type InstructionShape = array{action: string, type: 'perform'}
 */
final class Instruction implements BaseModel
{
    /** @use SdkModel<InstructionShape> */
    use SdkModel;

    /** @var 'perform' $type */
    #[Required]
    public string $type = 'perform';

    #[Required]
    public string $action;

    /**
     * `new Instruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Instruction::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Instruction)->withAction(...)
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
    public static function with(string $action): self
    {
        $self = new self;

        $self['action'] = $action;

        return $self;
    }

    public function withAction(string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    /**
     * @param 'perform' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
