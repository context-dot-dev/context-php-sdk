<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * What submission took in, and what it charged for.
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
     * URLs dropped before reserving because another entry resolved to the same page. Non-zero for sitemap crawls too, whose sitemaps routinely list a page more than once.
     */
    #[Required]
    public int $duplicates;

    /**
     * URLs from your list rejected as unusable; the same ones are itemised in `invalid_urls` at submission. Null for a crawl — a crawl that resolves no usable page is rejected outright with a 400 rather than accepted with an empty list.
     */
    #[Required]
    public ?int $invalid;

    /**
     * Pages credits were reserved for. Everything else — progress, the refund, the completion percentage — is measured against this.
     */
    #[Required]
    public int $reserved;

    /**
     * Whether `reserved` is an upper bound the batch may finish under. True only for a crawl that follows links, whose reachable page count is unknowable until it runs. False for a scrape and for a sitemap crawl, where `reserved` is an exact page count.
     */
    #[Required('reserved_is_ceiling')]
    public bool $reservedIsCeiling;

    /**
     * URLs in the list you sent, before validation and de-duplication. Null for a crawl, which is given a source rather than a list.
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
     * URLs dropped before reserving because another entry resolved to the same page. Non-zero for sitemap crawls too, whose sitemaps routinely list a page more than once.
     */
    public function withDuplicates(int $duplicates): self
    {
        $self = clone $this;
        $self['duplicates'] = $duplicates;

        return $self;
    }

    /**
     * URLs from your list rejected as unusable; the same ones are itemised in `invalid_urls` at submission. Null for a crawl — a crawl that resolves no usable page is rejected outright with a 400 rather than accepted with an empty list.
     */
    public function withInvalid(?int $invalid): self
    {
        $self = clone $this;
        $self['invalid'] = $invalid;

        return $self;
    }

    /**
     * Pages credits were reserved for. Everything else — progress, the refund, the completion percentage — is measured against this.
     */
    public function withReserved(int $reserved): self
    {
        $self = clone $this;
        $self['reserved'] = $reserved;

        return $self;
    }

    /**
     * Whether `reserved` is an upper bound the batch may finish under. True only for a crawl that follows links, whose reachable page count is unknowable until it runs. False for a scrape and for a sitemap crawl, where `reserved` is an exact page count.
     */
    public function withReservedIsCeiling(bool $reservedIsCeiling): self
    {
        $self = clone $this;
        $self['reservedIsCeiling'] = $reservedIsCeiling;

        return $self;
    }

    /**
     * URLs in the list you sent, before validation and de-duplication. Null for a crawl, which is given a source rather than a list.
     */
    public function withSubmitted(?int $submitted): self
    {
        $self = clone $this;
        $self['submitted'] = $submitted;

        return $self;
    }
}
