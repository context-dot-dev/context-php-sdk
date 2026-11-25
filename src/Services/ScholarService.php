<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\Scholar\ScholarSearchParams\FilterBy;
use ContextDev\Scholar\ScholarSearchParams\Sort;
use ContextDev\Scholar\ScholarSearchResponse;
use ContextDev\ServiceContracts\ScholarContract;

/**
 * Search full-text academic papers from arXiv and Europe PMC.
 *
 * @phpstan-import-type FilterByShape from \ContextDev\Scholar\ScholarSearchParams\FilterBy
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class ScholarService implements ScholarContract
{
    /**
     * @api
     */
    public ScholarRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ScholarRawService($client);
    }

    /**
     * @api
     *
     * Search full-text papers from arXiv and Europe PMC. Returns up to 250 relevant papers with matching passages and full-text links.
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
    ): ScholarSearchResponse {
        $params = Util::removeNulls(
            [
                'query' => $query,
                'cursor' => $cursor,
                'filterBy' => $filterBy,
                'limit' => $limit,
                'sort' => $sort,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
