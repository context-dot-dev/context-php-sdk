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
 * Search live and historical news about a company.
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
     * Find news about a company by name, domain, ticker, or ISIN, or search all news with a natural-language query. Filter articles and continue through results with a cursor.
     *
     * @param SearchByShape $searchBy what to search for: a specific company, or a natural-language query across all news
     * @param string|null $cursor opaque next_cursor from the previous response, or null for the first page
     * @param FilterBy|FilterByShape $filterBy Optional result filters. Use at most one of sourceDomain, sourceCountry, articleLanguage, or articleType. A date range may accompany that category; date.from must not exceed date.to.
     * @param int $limit Maximum results to return. Defaults to 10.
     * @param SortBy|SortByShape $sortBy Result ordering. Defaults to newest for entity searches. Natural-language searches are always ordered by relevance.
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        NewsSearchByNaturalLanguage|array|NewsSearchByEntity $searchBy,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        int $limit = 10,
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
                'sortBy' => $sortBy,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
