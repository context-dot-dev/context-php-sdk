<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Submission counts.
 *
 * @phpstan-type InputShape = array{
 *   accepted: int, duplicates: int, invalid: int, submitted: int
 * }
 */
final class Input implements BaseModel
{
    /** @use SdkModel<InputShape> */
    use SdkModel;

    /**
     * Pages accepted, or the crawl page limit. Credits are reserved for this count.
     */
    #[Required]
    public int $accepted;

    /**
     * Duplicate URL and `itemId` pairs skipped. Always 0 for crawls.
     */
    #[Required]
    public int $duplicates;

    /**
     * Pages rejected during validation.
     */
    #[Required]
    public int $invalid;

    /**
     * Pages submitted before validation. For a crawl, the page limit.
     */
    #[Required]
    public int $submitted;

    /**
     * `new Input()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Input::with(accepted: ..., duplicates: ..., invalid: ..., submitted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Input)
     *   ->withAccepted(...)
     *   ->withDuplicates(...)
     *   ->withInvalid(...)
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
        int $accepted,
        int $duplicates,
        int $invalid,
        int $submitted
    ): self {
        $self = new self;

        $self['accepted'] = $accepted;
        $self['duplicates'] = $duplicates;
        $self['invalid'] = $invalid;
        $self['submitted'] = $submitted;

        return $self;
    }

    /**
     * Pages accepted, or the crawl page limit. Credits are reserved for this count.
     */
    public function withAccepted(int $accepted): self
    {
        $self = clone $this;
        $self['accepted'] = $accepted;

        return $self;
    }

    /**
     * Duplicate URL and `itemId` pairs skipped. Always 0 for crawls.
     */
    public function withDuplicates(int $duplicates): self
    {
        $self = clone $this;
        $self['duplicates'] = $duplicates;

        return $self;
    }

    /**
     * Pages rejected during validation.
     */
    public function withInvalid(int $invalid): self
    {
        $self = clone $this;
        $self['invalid'] = $invalid;

        return $self;
    }

    /**
     * Pages submitted before validation. For a crawl, the page limit.
     */
    public function withSubmitted(int $submitted): self
    {
        $self = clone $this;
        $self['submitted'] = $submitted;

        return $self;
    }
}
