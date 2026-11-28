<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\News\NewsSearchParams\FilterBy;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByNaturalLanguage;
use ContextDev\News\NewsSearchParams\SortBy;
use ContextDev\News\NewsSearchResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\NewsContract;

/**
 * Search live and historical news by company or with a natural-language query.
 *
 * @phpstan-import-type SearchByShape from \ContextDev\News\NewsSearchParams\SearchBy
 * @phpstan-import-type FilterByShape from \ContextDev\News\NewsSearchParams\FilterBy
 * @phpstan-import-type SortByShape from \ContextDev\News\NewsSearchParams\SortBy
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class NewsService implements NewsContract
{
    /**
     * @api
     */
    public NewsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NewsRawService($client);
    }

    /**
     * @api
     *
     * Find news about a company by name, domain, ticker, or ISIN, or search all news with a natural-language query. Each article includes its publisher, type of coverage, and, for company searches, whether the company is the main subject. Narrow results by publisher, country, language, article type, or publish date.
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
    ): NewsSearchResponse {
        $params = Util::removeNulls(
            [
                'searchBy' => $searchBy,
                'cursor' => $cursor,
                'filterBy' => $filterBy,
                'limit' => $limit,
                'policies' => $policies,
                'sortBy' => $sortBy,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
