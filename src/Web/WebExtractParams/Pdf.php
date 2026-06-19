<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PdfShape = array{
 *   end?: int|null, shouldParse?: bool|null, start?: int|null
 * }
 */
final class Pdf implements BaseModel
{
    /** @use SdkModel<PdfShape> */
    use SdkModel;

    /**
     * Last 1-based PDF page to parse. Must be greater than or equal to start when both are provided.
     */
    #[Optional]
    public ?int $end;

    /**
     * When true, PDF pages are fetched and parsed. When false, PDF pages are skipped.
     */
    #[Optional]
    public ?bool $shouldParse;

    /**
     * First 1-based PDF page to parse.
     */
    #[Optional]
    public ?int $start;

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
        ?int $end = null,
        ?bool $shouldParse = null,
        ?int $start = null
    ): self {
        $self = new self;

        null !== $end && $self['end'] = $end;
        null !== $shouldParse && $self['shouldParse'] = $shouldParse;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * Last 1-based PDF page to parse. Must be greater than or equal to start when both are provided.
     */
    public function withEnd(int $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * When true, PDF pages are fetched and parsed. When false, PDF pages are skipped.
     */
    public function withShouldParse(bool $shouldParse): self
    {
        $self = clone $this;
        $self['shouldParse'] = $shouldParse;

        return $self;
    }

    /**
     * First 1-based PDF page to parse.
     */
    public function withStart(int $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
