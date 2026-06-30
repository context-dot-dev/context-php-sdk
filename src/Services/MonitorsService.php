<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\Mode;
use ContextDev\Monitors\MonitorCreateParams\Schedule;
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorCreateParams\Webhook;
use ContextDev\Monitors\MonitorDeleteResponse;
use ContextDev\Monitors\MonitorGetChangeResponse;
use ContextDev\Monitors\MonitorGetResponse;
use ContextDev\Monitors\MonitorListAccountChangesResponse;
use ContextDev\Monitors\MonitorListAccountRunsResponse;
use ContextDev\Monitors\MonitorListChangesResponse;
use ContextDev\Monitors\MonitorListParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListParams\SearchBy;
use ContextDev\Monitors\MonitorListParams\SearchType;
use ContextDev\Monitors\MonitorListParams\TargetType;
use ContextDev\Monitors\MonitorListResponse;
use ContextDev\Monitors\MonitorListRunsResponse;
use ContextDev\Monitors\MonitorNewResponse;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateParams\Status;
use ContextDev\Monitors\MonitorUpdateResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\MonitorsContract;

/**
 * Monitor pages, sitemaps, and extracted website data for exact or semantic changes. The change.detected webhook payload is documented by the MonitorsChangeDetectedWebhookPayload schema.
 *
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorCreateParams\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorCreateParams\Webhook
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorUpdateParams\ChangeDetection as ChangeDetectionShape1
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorUpdateParams\Schedule as ScheduleShape1
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorUpdateParams\Target as TargetShape1
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorUpdateParams\Webhook as WebhookShape1
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class MonitorsService implements MonitorsContract
{
    /**
     * @api
     */
    public MonitorsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MonitorsRawService($client);
    }

    /**
     * @api
     *
     * Creates a monitor. The request body is a union of the supported target/change detection combinations. The monitor runs immediately after creation to create its initial baseline.
     *
     * @param ChangeDetectionShape $changeDetection discriminated union describing how changes are detected
     * @param Schedule|ScheduleShape $schedule Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     * @param TargetShape $target discriminated union describing what the monitor watches
     * @param Mode|value-of<Mode> $mode Top-level monitor category. Always `web` today; the concrete behavior is described by `target` and `change_detection`.
     * @param list<string> $tags user-defined tags for grouping and filtering monitors and their changes
     * @param Webhook|WebhookShape|null $webhook
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection $changeDetection,
        string $name,
        Schedule|array $schedule,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target,
        Mode|string|null $mode = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorNewResponse {
        $params = Util::removeNulls(
            [
                'changeDetection' => $changeDetection,
                'name' => $name,
                'schedule' => $schedule,
                'target' => $target,
                'mode' => $mode,
                'tags' => $tags,
                'webhook' => $webhook,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a monitor
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($monitorID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Updates a monitor. If `target` or `change_detection` changes, the monitor creates a new baseline. Unsupported target/change detection combinations are rejected.
     *
     * @param ChangeDetectionShape1 $changeDetection discriminated union describing how changes are detected
     * @param \ContextDev\Monitors\MonitorUpdateParams\Schedule|ScheduleShape1 $schedule Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     * @param Status|value-of<Status> $status
     * @param list<string> $tags user-defined tags for grouping and filtering monitors and their changes
     * @param TargetShape1 $target discriminated union describing what the monitor watches
     * @param \ContextDev\Monitors\MonitorUpdateParams\Webhook|WebhookShape1|null $webhook set to null to remove the webhook
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $monitorID,
        \ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsExactChangeDetection|array|\ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsSemanticChangeDetection|null $changeDetection = null,
        ?string $name = null,
        \ContextDev\Monitors\MonitorUpdateParams\Schedule|array|null $schedule = null,
        Status|string|null $status = null,
        ?array $tags = null,
        \ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsPageTarget|array|\ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget|\ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsExtractTarget|null $target = null,
        \ContextDev\Monitors\MonitorUpdateParams\Webhook|array|null $webhook = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorUpdateResponse {
        $params = Util::removeNulls(
            [
                'changeDetection' => $changeDetection,
                'name' => $name,
                'schedule' => $schedule,
                'status' => $status,
                'tags' => $tags,
                'target' => $target,
                'webhook' => $webhook,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($monitorID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists monitors for the authenticated organization. Supports free-text search (`q` over `search_by` fields, `prefix` or `exact` via `search_type`) plus status/type/tag filters. Results are paginated via the opaque `cursor`.
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     * @param string $q free-text search term, matched against the fields named in `search_by`
     * @param list<SearchBy|value-of<SearchBy>> $searchBy Comma-separated fields to search with `q`. Defaults to all of them. Note `query` only exists on semantic monitors.
     * @param SearchType|value-of<SearchType> $searchType `prefix` for as-you-type prefix matching (default), `exact` for full-token matching
     * @param \ContextDev\Monitors\MonitorListParams\Status|value-of<\ContextDev\Monitors\MonitorListParams\Status> $status
     * @param string $tag filter to items that have this tag
     * @param list<string> $tags comma-separated list of tags to filter by (matches monitors having any of them)
     * @param TargetType|value-of<TargetType> $targetType
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        int $limit = 25,
        ?string $q = null,
        ?array $searchBy = null,
        SearchType|string $searchType = 'prefix',
        \ContextDev\Monitors\MonitorListParams\Status|string|null $status = null,
        ?string $tag = null,
        ?array $tags = null,
        TargetType|string|null $targetType = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorListResponse {
        $params = Util::removeNulls(
            [
                'changeDetectionType' => $changeDetectionType,
                'cursor' => $cursor,
                'limit' => $limit,
                'q' => $q,
                'searchBy' => $searchBy,
                'searchType' => $searchType,
                'status' => $status,
                'tag' => $tag,
                'tags' => $tags,
                'targetType' => $targetType,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a monitor
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($monitorID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns an account-wide feed of detected changes across monitors.
     *
     * @param \ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType|value-of<\ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType> $changeDetectionType
     * @param string $tag filter to items that have this tag
     * @param \ContextDev\Monitors\MonitorListAccountChangesParams\TargetType|value-of<\ContextDev\Monitors\MonitorListAccountChangesParams\TargetType> $targetType
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAccountChanges(
        \ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        int $limit = 25,
        ?string $monitorID = null,
        ?\DateTimeInterface $since = null,
        ?string $tag = null,
        \ContextDev\Monitors\MonitorListAccountChangesParams\TargetType|string|null $targetType = null,
        ?\DateTimeInterface $until = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorListAccountChangesResponse {
        $params = Util::removeNulls(
            [
                'changeDetectionType' => $changeDetectionType,
                'cursor' => $cursor,
                'limit' => $limit,
                'monitorID' => $monitorID,
                'since' => $since,
                'tag' => $tag,
                'targetType' => $targetType,
                'until' => $until,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listAccountChanges(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns an account-wide feed of monitor runs across all monitors.
     *
     * @param \ContextDev\Monitors\MonitorListAccountRunsParams\Status|value-of<\ContextDev\Monitors\MonitorListAccountRunsParams\Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAccountRuns(
        ?string $cursor = null,
        int $limit = 25,
        \ContextDev\Monitors\MonitorListAccountRunsParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorListAccountRunsResponse {
        $params = Util::removeNulls(
            ['cursor' => $cursor, 'limit' => $limit, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listAccountRuns(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List changes for a monitor
     *
     * @param string $tag filter to items that have this tag
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listChanges(
        string $monitorID,
        ?string $cursor = null,
        int $limit = 25,
        ?\DateTimeInterface $since = null,
        ?string $tag = null,
        ?\DateTimeInterface $until = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorListChangesResponse {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'limit' => $limit,
                'since' => $since,
                'tag' => $tag,
                'until' => $until,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listChanges($monitorID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List monitor runs
     *
     * @param \ContextDev\Monitors\MonitorListRunsParams\Status|value-of<\ContextDev\Monitors\MonitorListRunsParams\Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listRuns(
        string $monitorID,
        ?string $cursor = null,
        int $limit = 25,
        \ContextDev\Monitors\MonitorListRunsParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorListRunsResponse {
        $params = Util::removeNulls(
            ['cursor' => $cursor, 'limit' => $limit, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listRuns($monitorID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a change
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveChange(
        string $changeID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorGetChangeResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveChange($changeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Triggers an immediate run of the monitor outside its normal schedule. The run is queued and processed asynchronously.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function run(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorRunResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->run($monitorID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
