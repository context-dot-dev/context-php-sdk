<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractCompetitorsResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Profile of the requested company, inferred from its website.
 *
 * @phpstan-type TargetShape = array{
 *   companyName: string,
 *   field: string,
 *   fieldDescription: string,
 *   websiteURL: string,
 * }
 */
final class Target implements BaseModel
{
    /** @use SdkModel<TargetShape> */
    use SdkModel;

    /**
     * Company or product name, inferred from its website.
     */
    #[Required]
    public string $companyName;

    /**
     * Product category or market the company operates in.
     */
    #[Required]
    public string $field;

    /**
     * One-sentence summary of what the company sells and who it serves.
     */
    #[Required]
    public string $fieldDescription;

    /**
     * Website URL that was analyzed.
     */
    #[Required('websiteUrl')]
    public string $websiteURL;

    /**
     * `new Target()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Target::with(
     *   companyName: ..., field: ..., fieldDescription: ..., websiteURL: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Target)
     *   ->withCompanyName(...)
     *   ->withField(...)
     *   ->withFieldDescription(...)
     *   ->withWebsiteURL(...)
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
    public static function with(
        string $companyName,
        string $field,
        string $fieldDescription,
        string $websiteURL,
    ): self {
        $self = new self;

        $self['companyName'] = $companyName;
        $self['field'] = $field;
        $self['fieldDescription'] = $fieldDescription;
        $self['websiteURL'] = $websiteURL;

        return $self;
    }

    /**
     * Company or product name, inferred from its website.
     */
    public function withCompanyName(string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    /**
     * Product category or market the company operates in.
     */
    public function withField(string $field): self
    {
        $self = clone $this;
        $self['field'] = $field;

        return $self;
    }

    /**
     * One-sentence summary of what the company sells and who it serves.
     */
    public function withFieldDescription(string $fieldDescription): self
    {
        $self = clone $this;
        $self['fieldDescription'] = $fieldDescription;

        return $self;
    }

    /**
     * Website URL that was analyzed.
     */
    public function withWebsiteURL(string $websiteURL): self
    {
        $self = clone $this;
        $self['websiteURL'] = $websiteURL;

        return $self;
    }
}
