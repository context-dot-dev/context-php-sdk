<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchDeleteResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape;
use ContextDev\Batch\BatchSubmitParams\Webhook;
use ContextDev\Batch\BatchSubmitResponse;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\BatchContract;

/**
 * Scrape up to 100,000 URLs or crawl a site asynchronously.
 *
 * @phpstan-import-type TagsShape from \ContextDev\Batch\BatchListParams\Tags
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchSubmitParams\Input
 * @phpstan-import-type WebhookShape from \ContextDev\Batch\BatchSubmitParams\Webhook
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class BatchService implements BatchContract
{
    /**
     * @api
     */
    public BatchRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BatchRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a batch's status, progress, and credit usage, plus links to download its results once it finishes. Result files are deleted 180 days after the batch finishes.
     *
     * @param string $batchID ID of the batch
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($batchID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List your batches, newest first. Filter by status or tags, or search by batch ID, crawl source, or tag.
     *
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit maximum number of batches to return per page
     * @param string $q search term matched against batch IDs, crawl sources (start URL or sitemap domain), and tags
     * @param SearchType|value-of<SearchType> $searchType How `q` matches: `prefix` matches the start of a term, for search-as-you-type, and `exact` matches whole terms. Defaults to `prefix`.
     * @param Status|value-of<Status> $status filter by batch status
     * @param TagsShape $tags Comma-separated tags. Returns batches that have any of them. You can also repeat the `tags` parameter.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        int $limit = 25,
        ?string $q = null,
        SearchType|string|null $searchType = null,
        Status|string|null $status = null,
        string|array|null $tags = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchListResponse {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'limit' => $limit,
                'q' => $q,
                'searchType' => $searchType,
                'status' => $status,
                'tags' => $tags,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently delete a finished batch and its results. Its webhook deliveries can no longer be retried.
     *
     * @param string $batchID ID of the batch
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($batchID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop a batch from starting new pages. Pages already in progress finish, then the batch becomes `cancelled` and unused credits are refunded.
     *
     * @param string $batchID ID of the batch
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $batchID,
        RequestOptions|array|null $requestOptions = null
    ): BatchCancelResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($batchID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Page through a finished batch's results as JSON. Each record's `result` has the same outputs and per-format errors as `POST /web/scrape`. Results are kept for 180 days after the batch finishes.
     *
     * @param string $batchID ID of the batch
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit Maximum number of results to return per page. A page can hold fewer to stay under about 8 MB, so page with `next_cursor` instead of counting records.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getResults(
        string $batchID,
        ?string $cursor = null,
        int $limit = 25,
        RequestOptions|array|null $requestOptions = null,
    ): BatchGetResultsResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getResults($batchID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Scrape up to 100,000 URLs, or crawl a site, asynchronously with every Scrape Anything format and option from `POST /web/scrape`. Poll `GET /batch/{batch_id}` or pass `webhook` to be notified when the batch finishes. URLs and credits are checked after the batch is accepted, so a batch that fails those checks ends as `failed` with a `failure` code instead of returning an error.
     *
     * @param InputShape $input body param: What to scrape: a list of URLs (`scrape`) or a site crawl (`crawl`)
     * @param list<string> $policies Body param: Access policy IDs to apply to every page; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param list<string> $tags Body param: Tags to store on the batch. Filter `GET /batch/list` by them later.
     * @param Webhook|WebhookShape $webhook Body param: Webhook to notify when the batch finishes. Omit `retry` for a single attempt, or pass `retry: {}` for the default retry schedule.
     * @param string $idempotencyKey Header param: Unique key for this submission. Retrying with the same key and body returns the original batch instead of creating another; a different body returns `409`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        Scrape|array|Crawl $input,
        ?array $policies = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        ?string $idempotencyKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchSubmitResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'policies' => $policies,
                'tags' => $tags,
                'webhook' => $webhook,
                'idempotencyKey' => $idempotencyKey,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
