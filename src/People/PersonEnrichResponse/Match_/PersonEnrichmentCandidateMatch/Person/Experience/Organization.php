<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch\Person\Experience;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type OrganizationShape = array{name: string, domain?: string|null}
 */
final class Organization implements BaseModel
{
    /** @use SdkModel<OrganizationShape> */
    use SdkModel;

    #[Required]
    public string $name;

    #[Optional]
    public ?string $domain;

    /**
     * `new Organization()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Organization::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Organization)->withName(...)
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
    public static function with(string $name, ?string $domain = null): self
    {
        $self = new self;

        $self['name'] = $name;

        null !== $domain && $self['domain'] = $domain;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }
}
