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
     * Search the full text of papers from arXiv and Europe PMC by topic or question. Each result includes the matching passage and a direct link to the full text. Page through up to 250 matches, ranked by relevance or newest first.
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
