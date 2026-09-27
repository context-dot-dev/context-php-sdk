<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichParams\Education;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * School or university, identified by name or domain.
 *
 * @phpstan-type InstitutionShape = array{domain?: string|null, name?: string|null}
 */
final class Institution implements BaseModel
{
    /** @use SdkModel<InstitutionShape> */
    use SdkModel;

    /**
     * Website domain of the school or university.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Name of the school or university.
     */
    #[Optional]
    public ?string $name;

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
        ?string $domain = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $domain && $self['domain'] = $domain;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Website domain of the school or university.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Name of the school or university.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
