<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Bytes;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{base64: string, contentType: string}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Original response body as base64, after HTTP decompression. Maximum decoded size: 20 MiB.
     */
    #[Required]
    public string $base64;

    #[Required]
    public string $contentType;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(base64: ..., contentType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withBase64(...)->withContentType(...)
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
    public static function with(string $base64, string $contentType): self
    {
        $self = new self;

        $self['base64'] = $base64;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * Original response body as base64, after HTTP decompression. Maximum decoded size: 20 MiB.
     */
    public function withBase64(string $base64): self
    {
        $self = clone $this;
        $self['base64'] = $base64;

        return $self;
    }

    public function withContentType(string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }
}
