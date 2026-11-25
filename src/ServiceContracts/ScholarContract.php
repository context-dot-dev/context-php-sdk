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
     * @param string $query A topic or question. Append one arxiv:, pmcid:, pmid:, or doi: ID to search within an indexed paper.
     * @param string|null $cursor use next_cursor to fetch the next page
     * @param FilterBy|FilterByShape $filterBy filter by publication date
     * @param int $limit papers per page
     * @param Sort|value-of<Sort> $sort Order the top 250 matches. date_desc puts newest first, with undated papers last.
     * @param list<string> $tags labels for filtering usage in the dashboard
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
