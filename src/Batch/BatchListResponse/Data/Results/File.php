<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data\Results;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileShape = array{bytes: int, items: int, url: string}
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    /**
     * Compressed file size in bytes.
     */
    #[Required]
    public int $bytes;

    /**
     * Results in this file.
     */
    #[Required]
    public int $items;

    /**
     * Temporary URL for a gzipped NDJSON file.
     */
    #[Required]
    public string $url;

    /**
     * `new File()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * File::with(bytes: ..., items: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new File)->withBytes(...)->withItems(...)->withURL(...)
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
    public static function with(int $bytes, int $items, string $url): self
    {
        $self = new self;

        $self['bytes'] = $bytes;
        $self['items'] = $items;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Compressed file size in bytes.
     */
    public function withBytes(int $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Results in this file.
     */
    public function withItems(int $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Temporary URL for a gzipped NDJSON file.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
