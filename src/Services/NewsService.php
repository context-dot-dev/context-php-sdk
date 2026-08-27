<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\News\NewsSearchParams\FilterBy;
use ContextDev\News\NewsSearchParams\SearchBy;
use ContextDev\News\NewsSearchParams\SortBy;
use ContextDev\News\NewsSearchResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\NewsContract;

/**
 * Search live first-party RSS and free historical news data by company identity.
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
     * Searches live and historical company news for one company, identified in searchBy by name, domain, ticker (optionally disambiguated by exchange), or ISIN. Results can be filtered by publisher domain, publisher country, article language, article type, and published-at date, and include stable story IDs, source metadata, verified entity relevance, and cursor pagination.
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
