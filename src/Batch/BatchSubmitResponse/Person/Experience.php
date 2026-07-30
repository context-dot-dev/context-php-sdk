<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Person;

use ContextDev\Batch\BatchSubmitResponse\Person\Experience\Company;
use ContextDev\Batch\BatchSubmitResponse\Person\Experience\Dates;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CompanyShape from \ContextDev\Batch\BatchSubmitResponse\Person\Experience\Company
 * @phpstan-import-type DatesShape from \ContextDev\Batch\BatchSubmitResponse\Person\Experience\Dates
 *
 * @phpstan-type ExperienceShape = array{
 *   company: Company|CompanyShape,
 *   title: string,
 *   dates?: null|Dates|DatesShape,
 *   description?: string|null,
 * }
 */
final class Experience implements BaseModel
{
    /** @use SdkModel<ExperienceShape> */
    use SdkModel;

    /**
     * Company or organization name.
     */
    #[Required]
    public Company $company;

    /**
     * Role or job title.
     */
    #[Required]
    public string $title;

    /**
     * Role dates.
     */
    #[Optional]
    public ?Dates $dates;

    /**
     * Role description.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new Experience()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Experience::with(company: ..., title: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Experience)->withCompany(...)->withTitle(...)
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
     * @param Company|CompanyShape $company
     * @param Dates|DatesShape|null $dates
     */
    public static function with(
        Company|array $company,
        string $title,
        Dates|array|null $dates = null,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['company'] = $company;
        $self['title'] = $title;

        null !== $dates && $self['dates'] = $dates;
        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Company or organization name.
     *
     * @param Company|CompanyShape $company
     */
    public function withCompany(Company|array $company): self
    {
        $self = clone $this;
        $self['company'] = $company;

        return $self;
    }

    /**
     * Role or job title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Role dates.
     *
     * @param Dates|DatesShape $dates
     */
    public function withDates(Dates|array $dates): self
    {
        $self = clone $this;
        $self['dates'] = $dates;

        return $self;
    }

    /**
     * Role description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
