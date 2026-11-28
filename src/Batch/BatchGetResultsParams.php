<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Page through a finished batch's results as JSON. Each record's `result` has the same outputs and per-format errors as `POST /web/scrape`. Results are kept for 180 days after the batch finishes.
 *
 * @see ContextDev\Services\BatchService::getResults()
 *
 * @phpstan-type BatchGetResultsParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class BatchGetResultsParams implements BaseModel
{
    /** @use SdkModel<BatchGetResultsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of results to return per page. A page can hold fewer to stay under about 8 MB, so page with `next_cursor` instead of counting records.
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of results to return per page. A page can hold fewer to stay under about 8 MB, so page with `next_cursor` instead of counting records.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
