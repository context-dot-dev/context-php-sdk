<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\News\NewsSearchParams;
use ContextDev\News\NewsSearchParams\FilterBy;
use ContextDev\News\NewsSearchParams\SearchBy;
use ContextDev\News\NewsSearchParams\SortBy;
use ContextDev\News\NewsSearchResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\NewsRawContract;

/**
 * Search live first-party RSS and free historical news data by company identity.
 *
 * @phpstan-import-type SearchByShape from \ContextDev\News\NewsSearchParams\SearchBy
 * @phpstan-import-type FilterByShape from \ContextDev\News\NewsSearchParams\FilterBy
 * @phpstan-import-type SortByShape from \ContextDev\News\NewsSearchParams\SortBy
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class NewsRawService implements NewsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Searches live and historical company news for one company, identified in searchBy by name, domain, ticker (optionally disambiguated by exchange), or ISIN. Results can be filtered by publisher domain, publisher country, article language, article type, and published-at date, and include stable story IDs, source metadata, verified entity relevance, and cursor pagination.
     *
     * @param array{
     *   searchBy: SearchBy|SearchByShape,
     *   cursor?: string|null,
     *   filterBy?: FilterBy|FilterByShape,
     *   limit?: int,
     *   sortBy?: SortBy|SortByShape,
     *   tags?: list<string>,
     * }|NewsSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NewsSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|NewsSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NewsSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'news/search',
            body: (object) $parsed,
            options: $options,
            convert: NewsSearchResponse::class,
        );
    }
}
