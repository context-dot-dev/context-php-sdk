<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\News\NewsSearchParams\FilterBy;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByNaturalLanguage;
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
     * @param SearchByShape $searchBy what to search for: news about a specific company, or a natural-language query across all news
     * @param string|null $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param FilterBy|FilterByShape $filterBy Filters for the results. Use at most one of `sourceDomain`, `sourceCountry`, `articleLanguage`, or `articleType`, optionally combined with `date`.
     * @param int $limit maximum number of articles to return per page
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param SortBy|SortByShape $sortBy How to order results. Company searches default to `newest`; natural-language searches always use `relevance`.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        NewsSearchByNaturalLanguage|array|NewsSearchByEntity $searchBy,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        int $limit = 10,
        ?array $policies = null,
        SortBy|array|null $sortBy = null,
        ?array $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): NewsSearchResponse;
}
