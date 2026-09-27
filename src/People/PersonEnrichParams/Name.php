<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Person name. Without an email or person-profile URL, provide both first and last name plus company, education, or location.
 *
 * @phpstan-type NameShape = array{first?: string|null, last?: string|null}
 */
final class Name implements BaseModel
{
    /** @use SdkModel<NameShape> */
    use SdkModel;

    /**
     * First or given name.
     */
    #[Optional]
    public ?string $first;

    /**
     * Last or family name.
     */
    #[Optional]
    public ?string $last;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $first = null, ?string $last = null): self
    {
        $self = new self;

        null !== $first && $self['first'] = $first;
        null !== $last && $self['last'] = $last;

        return $self;
    }

    /**
     * First or given name.
     */
    public function withFirst(string $first): self
    {
        $self = clone $this;
        $self['first'] = $first;

        return $self;
    }

    /**
     * Last or family name.
     */
    public function withLast(string $last): self
    {
        $self = clone $this;
        $self['last'] = $last;

        return $self;
    }
}
