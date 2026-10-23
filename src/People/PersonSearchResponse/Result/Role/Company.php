<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchResponse\Result\Role;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Current employer, when known.
 *
 * @phpstan-type CompanyShape = array{domain: string|null, name: string|null}
 */
final class Company implements BaseModel
{
    /** @use SdkModel<CompanyShape> */
    use SdkModel;

    /**
     * The company’s website domain.
     */
    #[Required]
    public ?string $domain;

    /**
     * Company name.
     */
    #[Required]
    public ?string $name;

    /**
     * `new Company()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Company::with(domain: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Company)->withDomain(...)->withName(...)
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
    public static function with(?string $domain, ?string $name): self
    {
        $self = new self;

        $self['domain'] = $domain;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The company’s website domain.
     */
    public function withDomain(?string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Company name.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
