<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Batch\BatchCancelResponse\Results\File;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Download links, available once the batch reaches a final status and null before then. GET /batch/{batch_id}/results serves the same records as paginated JSON.
 *
 * @phpstan-import-type FileShape from \ContextDev\Batch\BatchCancelResponse\Results\File
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
     * When the download URLs expire.
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
     * When the download URLs expire.
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
