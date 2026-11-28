<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Scholar\ScholarSearchParams\FilterBy;
use ContextDev\Scholar\ScholarSearchParams\Sort;
use ContextDev\Scholar\ScholarSearchResponse;

/**
 * @phpstan-import-type FilterByShape from \ContextDev\Scholar\ScholarSearchParams\FilterBy
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ScholarContract
{
    /**
     * @api
     *
     * @param string $query Topic or question to search for. Append one `arxiv:`, `pmcid:`, `pmid:`, or `doi:` ID to search within that paper, such as `protein folding pmid:34265844`, or send the ID on its own.
     * @param string|null $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param FilterBy|FilterByShape $filterBy filter by publication date
     * @param int $limit maximum number of papers to return per page
     * @param Sort|value-of<Sort> $sort `relevance` puts the closest matches first; `date_desc` puts the newest papers first, with undated papers last. Both orders apply to the top 250 matches.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        int $limit = 10,
        Sort|string $sort = 'relevance',
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): ScholarSearchResponse;
}
