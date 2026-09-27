<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Company context to help identify the person. Provide a name or domain.
 *
 * @phpstan-type CompanyShape = array{domain?: string|null, name?: string|null}
 */
final class Company implements BaseModel
{
    /** @use SdkModel<CompanyShape> */
    use SdkModel;

    /**
     * Website domain of a company associated with the person.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Name of a company associated with the person.
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
     * Website domain of a company associated with the person.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Name of a company associated with the person.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
