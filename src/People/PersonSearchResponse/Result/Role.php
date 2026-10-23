<?php

declare(strict_types=1);

namespace ContextDev\People\PersonSearchResponse\Result;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonSearchResponse\Result\Role\Company;

/**
 * The person’s current role.
 *
 * @phpstan-import-type CompanyShape from \ContextDev\People\PersonSearchResponse\Result\Role\Company
 *
 * @phpstan-type RoleShape = array{
 *   company: null|Company|CompanyShape,
 *   functions: list<string>,
 *   seniority: string|null,
 *   startedOn: string|null,
 *   title: string|null,
 * }
 */
final class Role implements BaseModel
{
    /** @use SdkModel<RoleShape> */
    use SdkModel;

    /**
     * Current employer, when known.
     */
    #[Required]
    public ?Company $company;

    /**
     * Areas of responsibility.
     *
     * @var list<string> $functions
     */
    #[Required(list: 'string')]
    public array $functions;

    /**
     * Seniority level.
     */
    #[Required]
    public ?string $seniority;

    /**
     * Role start date (YYYY-MM-DD).
     */
    #[Required('started_on')]
    public ?string $startedOn;

    /**
     * Job title.
     */
    #[Required]
    public ?string $title;

    /**
     * `new Role()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Role::with(
     *   company: ..., functions: ..., seniority: ..., startedOn: ..., title: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Role)
     *   ->withCompany(...)
     *   ->withFunctions(...)
     *   ->withSeniority(...)
     *   ->withStartedOn(...)
     *   ->withTitle(...)
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
     *
     * @param Company|CompanyShape|null $company
     * @param list<string> $functions
     */
    public static function with(
        Company|array|null $company,
        array $functions,
        ?string $seniority,
        ?string $startedOn,
        ?string $title,
    ): self {
        $self = new self;

        $self['company'] = $company;
        $self['functions'] = $functions;
        $self['seniority'] = $seniority;
        $self['startedOn'] = $startedOn;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Current employer, when known.
     *
     * @param Company|CompanyShape|null $company
     */
    public function withCompany(Company|array|null $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * Areas of responsibility.
     *
     * @param list<string> $functions
     */
    public function withFunctions(array $functions): self
    {
        $self = clone $this;
        $self['functions'] = $functions;

        return $self;
    }

    /**
     * Seniority level.
     */
    public function withSeniority(?string $seniority): self
    {
        $self = clone $this;
        $self['seniority'] = $seniority;

        return $self;
    }

    /**
     * Role start date (YYYY-MM-DD).
     */
    public function withStartedOn(?string $startedOn): self
    {
        $self = clone $this;
        $self['startedOn'] = $startedOn;

        return $self;
    }

    /**
     * Job title.
     */
    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
