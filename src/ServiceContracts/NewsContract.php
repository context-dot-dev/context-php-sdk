<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\News\NewsSearchParams\FilterBy;
use ContextDev\News\NewsSearchParams\SearchBy;
use ContextDev\News\NewsSearchParams\SortBy;
use ContextDev\News\NewsSearchResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type SearchByShape from \ContextDev\News\NewsSearchParams\SearchBy
 * @phpstan-import-type FilterByShape from \ContextDev\News\NewsSearchParams\FilterBy
 * @phpstan-import-type SortByShape from \ContextDev\News\NewsSearchParams\SortBy
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface NewsContract
{
    /**
     * @api
     *
     * @param SearchBy|SearchByShape $searchBy what to search for
     * @param string|null $cursor opaque next_cursor from the previous response, or null for the first page
     * @param FilterBy|FilterByShape $filterBy optional result filters
     * @param int $limit Maximum results to return. Defaults to 10.
     * @param SortBy|SortByShape $sortBy Result ordering. Defaults to newest.
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        SearchBy|array $searchBy,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        int $limit = 10,
        SortBy|array $sortBy = ['type' => 'newest'],
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): NewsSearchResponse;
}
