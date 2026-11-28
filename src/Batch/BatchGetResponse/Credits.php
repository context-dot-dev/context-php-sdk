<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Credits reserved, refunded, and charged for the batch.
 *
 * @phpstan-type CreditsShape = array{
 *   net: int, ocrCharged: int, refunded: int, reserved: int
 * }
 */
final class Credits implements BaseModel
{
    /** @use SdkModel<CreditsShape> */
    use SdkModel;

    /**
     * `reserved` minus `refunded` plus `ocr_charged`.
     */
    #[Required]
    public int $net;

    /**
     * Credits charged for OCR when the batch finishes.
     */
    #[Required('ocr_charged')]
    public int $ocrCharged;

    /**
     * Credits returned when the batch finishes, such as for failed or unattempted pages.
     */
    #[Required]
    public int $refunded;

    /**
     * Credits reserved before scraping starts. `0` while `pending`.
     */
    #[Required]
    public int $reserved;

    /**
     * `new Credits()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Credits::with(net: ..., ocrCharged: ..., refunded: ..., reserved: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Credits)
     *   ->withNet(...)
     *   ->withOcrCharged(...)
     *   ->withRefunded(...)
     *   ->withReserved(...)
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
        int $net,
        int $ocrCharged,
        int $refunded,
        int $reserved
    ): self {
        $self = new self;

        $self['net'] = $net;
        $self['ocrCharged'] = $ocrCharged;
        $self['refunded'] = $refunded;
        $self['reserved'] = $reserved;

        return $self;
    }

    /**
     * `reserved` minus `refunded` plus `ocr_charged`.
     */
    public function withNet(int $net): self
    {
        $self = clone $this;
        $self['net'] = $net;

        return $self;
    }

    /**
     * Credits charged for OCR when the batch finishes.
     */
    public function withOcrCharged(int $ocrCharged): self
    {
        $self = clone $this;
        $self['ocrCharged'] = $ocrCharged;

        return $self;
    }

    /**
     * Credits returned when the batch finishes, such as for failed or unattempted pages.
     */
    public function withRefunded(int $refunded): self
    {
        $self = clone $this;
        $self['refunded'] = $refunded;

        return $self;
    }

    /**
     * Credits reserved before scraping starts. `0` while `pending`.
     */
    public function withReserved(int $reserved): self
    {
        $self = clone $this;
        $self['reserved'] = $reserved;

        return $self;
    }
}
