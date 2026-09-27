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
 * Scrape many pages or crawl a site asynchronously.
 *
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
     * Get batch progress and result download links. Result files are deleted 7 days after the batch finishes.
     *
     * @param string $batchID batch ID
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
     * List your batches, newest first, with optional filters.
     *
     * @param string $cursor cursor from the previous page
     * @param int $limit Batches per page. Defaults to 25.
     * @param string $q free-text search term, matched against the batch id, crawl source (start URL or sitemap domain), and tags
     * @param SearchType|value-of<SearchType> $searchType `prefix` for as-you-type prefix matching (default), `exact` for full-token matching
     * @param Status|value-of<Status> $status filter by status
     * @param string $tags comma-separated list of tags to filter by (matches batches having any of them)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $q = null,
        SearchType|string|null $searchType = null,
        Status|string|null $status = null,
        ?string $tags = null,
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
     * @param string $batchID batch ID
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
     * Stop a batch from starting new pages. Pages already in progress finish before the batch becomes cancelled.
     *
     * @param string $batchID batch ID
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
     * Page through a finished batch’s results as JSON. Results remain available for 7 days.
     *
     * @param string $batchID batch ID
     * @param string $cursor next_cursor from the previous page
     * @param int $limit Records per page. Defaults to 25. A page can close early so its payload stays under ~8 MB; rely on next_cursor rather than counting records.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getResults(
        string $batchID,
        ?string $cursor = null,
        ?int $limit = null,
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
     * Scrape up to 25,000 URLs, or crawl a site, asynchronously. Poll the batch ID or receive a webhook when it finishes.
     *
     * @param InputShape $input body param: Choose a URL list or a site crawl
     * @param list<string> $tags Body param: Tags stored on the batch. Filter the batch list by them later.
     * @param Webhook|WebhookShape $webhook Body param: Where to send the batch's final-status event. Omit `retry` for one attempt; `{}` uses the default retry schedule.
     * @param string $webhookURL Body param: Legacy URL notified when the batch finishes. Preserves one best-effort attempt. Cannot be combined with webhook.
     * @param string $idempotencyKey Header param: Unique key per submission. Retrying with the same key and body returns the original batch; a different body returns `409`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        Scrape|array|Crawl $input,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        ?string $webhookURL = null,
        ?string $idempotencyKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): BatchSubmitResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'tags' => $tags,
                'webhook' => $webhook,
                'webhookURL' => $webhookURL,
                'idempotencyKey' => $idempotencyKey,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
