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
 * Search live and historical news about a company.
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
     * Find company news by name, domain, ticker, or ISIN. Filter articles and continue through results with a cursor.
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
