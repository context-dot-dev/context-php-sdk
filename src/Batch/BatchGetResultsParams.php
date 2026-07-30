<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Page through the result records of a finished batch as JSON, in the same order as the downloadable result files. Use this instead of downloading and parsing the NDJSON files yourself.
 *
 * @see ContextDev\Services\BatchService::getResults()
 *
 * @phpstan-type BatchGetResultsParamsShape = array{
 *   cursor?: string|null, limit?: int|null, tags?: list<string>|null
 * }
 */
final class BatchGetResultsParams implements BaseModel
{
    /** @use SdkModel<BatchGetResultsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * next_cursor from the previous page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Records per page. Defaults to 25. A page can close early so its payload stays under ~8 MB; rely on next_cursor rather than counting records.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $cursor = null,
        ?int $limit = null,
        ?array $tags = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * next_cursor from the previous page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Records per page. Defaults to 25. A page can close early so its payload stays under ~8 MB; rely on next_cursor rather than counting records.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
