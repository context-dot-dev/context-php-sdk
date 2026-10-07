<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

use ContextDev\Batch\BatchListResponse\Data\Results\File;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Result download links; null until the batch finishes. Files are deleted 180 days after the batch finishes.
 *
 * @phpstan-import-type FileShape from \ContextDev\Batch\BatchListResponse\Data\Results\File
 *
 * @phpstan-type ResultsShape = array{
 *   expiresAt: string, files: list<File|FileShape>
 * }
 */
final class Results implements BaseModel
{
    /** @use SdkModel<ResultsShape> */
    use SdkModel;

    /**
     * When these links expire (24 hours after this response).
     */
    #[Required('expires_at')]
    public string $expiresAt;

    /**
     * Result files. Order is not guaranteed.
     *
     * @var list<File> $files
     */
    #[Required(list: File::class)]
    public array $files;

    /**
     * `new Results()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Results::with(expiresAt: ..., files: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Results)->withExpiresAt(...)->withFiles(...)
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
     * @param list<File|FileShape> $files
     */
    public static function with(string $expiresAt, array $files): self
    {
        $self = new self;

        $self['expiresAt'] = $expiresAt;
        $self['files'] = $files;

        return $self;
    }

    /**
     * When these links expire (24 hours after this response).
     */
    public function withExpiresAt(string $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Result files. Order is not guaranteed.
     *
     * @param list<File|FileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }
}
