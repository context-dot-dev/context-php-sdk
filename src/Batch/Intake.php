<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Page counts from your submission.
 *
 * @phpstan-type IntakeShape = array{
 *   duplicates: int,
 *   invalid: int|null,
 *   reserved: int,
 *   reservedIsCeiling: bool,
 *   submitted: int|null,
 * }
 */
final class Intake implements BaseModel
{
    /** @use SdkModel<IntakeShape> */
    use SdkModel;

    /**
     * URLs dropped because another entry resolved to the same page. Sitemap crawls report duplicates too, since sitemaps often list a page more than once.
     */
    #[Required]
    public int $duplicates;

    /**
     * URLs rejected as invalid. `null` for a crawl.
     */
    #[Required]
    public ?int $invalid;

    /**
     * Pages accepted for scraping. `progress` counts toward this total.
     */
    #[Required]
    public int $reserved;

    /**
     * `true` when `reserved` is a crawl ceiling, `false` when it is an exact URL count.
     */
    #[Required('reserved_is_ceiling')]
    public bool $reservedIsCeiling;

    /**
     * URLs in your list before validation and de-duplication. `null` for a crawl.
     */
    #[Required]
    public ?int $submitted;

    /**
     * `new Intake()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Intake::with(
     *   duplicates: ...,
     *   invalid: ...,
     *   reserved: ...,
     *   reservedIsCeiling: ...,
     *   submitted: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Intake)
     *   ->withDuplicates(...)
     *   ->withInvalid(...)
     *   ->withReserved(...)
     *   ->withReservedIsCeiling(...)
     *   ->withSubmitted(...)
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
        int $duplicates,
        ?int $invalid,
        int $reserved,
        bool $reservedIsCeiling,
        ?int $submitted,
    ): self {
        $self = new self;

        $self['duplicates'] = $duplicates;
        $self['invalid'] = $invalid;
        $self['reserved'] = $reserved;
        $self['reservedIsCeiling'] = $reservedIsCeiling;
        $self['submitted'] = $submitted;

        return $self;
    }

    /**
     * URLs dropped because another entry resolved to the same page. Sitemap crawls report duplicates too, since sitemaps often list a page more than once.
     */
    public function withDuplicates(int $duplicates): self
    {
        $self = clone $this;
        $self['duplicates'] = $duplicates;

        return $self;
    }

    /**
     * URLs rejected as invalid. `null` for a crawl.
     */
    public function withInvalid(?int $invalid): self
    {
        $self = clone $this;
        $self['invalid'] = $invalid;

        return $self;
    }

    /**
     * Pages accepted for scraping. `progress` counts toward this total.
     */
    public function withReserved(int $reserved): self
    {
        $self = clone $this;
        $self['reserved'] = $reserved;

        return $self;
    }

    /**
     * `true` when `reserved` is a crawl ceiling, `false` when it is an exact URL count.
     */
    public function withReservedIsCeiling(bool $reservedIsCeiling): self
    {
        $self = clone $this;
        $self['reservedIsCeiling'] = $reservedIsCeiling;

        return $self;
    }

    /**
     * URLs in your list before validation and de-duplication. `null` for a crawl.
     */
    public function withSubmitted(?int $submitted): self
    {
        $self = clone $this;
        $self['submitted'] = $submitted;

        return $self;
    }
}
