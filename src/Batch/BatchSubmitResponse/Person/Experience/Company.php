<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Person\Experience;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Company or organization name.
 *
 * @phpstan-type CompanyShape = array{display: string, normalized?: string|null}
 */
final class Company implements BaseModel
{
    /** @use SdkModel<CompanyShape> */
    use SdkModel;

    /**
     * Display name.
     */
    #[Required]
    public string $display;

    /**
     * Standardized name, when available.
     */
    #[Optional]
    public ?string $normalized;

    /**
     * `new Company()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Company::with(display: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Company)->withDisplay(...)
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
        string $display,
        ?string $normalized = null
    ): self {
        $self = new self;

        $self['display'] = $display;

        null !== $normalized && $self['normalized'] = $normalized;

        return $self;
    }

    /**
     * Display name.
     */
    public function withDisplay(string $display): self
    {
        $self = clone $this;
        $self['display'] = $display;

        return $self;
    }

    /**
     * Standardized name, when available.
     */
    public function withNormalized(string $normalized): self
    {
        $self = clone $this;
        $self['normalized'] = $normalized;

        return $self;
    }
}
