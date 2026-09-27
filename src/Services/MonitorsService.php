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
use ContextDev\Monitors\MonitorGetCreditUsageResponse;
use ContextDev\Monitors\MonitorGetLimitsResponse;
use ContextDev\Monitors\MonitorGetResponse;
use ContextDev\Monitors\MonitorGetRunResponse;
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
use ContextDev\Monitors\MonitorRotateWebhookSecretResponse;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateParams\Status;
use ContextDev\Monitors\MonitorUpdateResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\MonitorsContract;

/**
 * Watch websites for exact or meaningful changes.
 *
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorCreateParams\Schedule
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
     * Watch a page, URL inventory, or extracted website data on a schedule. A run starts immediately to capture the baseline.
     *
     * @param string $name display name for the monitor
     * @param TargetShape $target what to watch: a page, a sitemap, or data extracted from a site
     * @param ChangeDetectionShape $changeDetection How changes are judged. Defaults to `semantic` for extract targets and page targets with `instructions`, otherwise `exact`.
     * @param Mode|value-of<Mode> $mode Always `web`. Optional.
     * @param Schedule|ScheduleShape $schedule Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     * @param list<string> $tags labels for filtering monitors, their changes, and their usage
     * @param Webhook|WebhookShape|null $webhook Webhook destination and delivery settings. Null means no webhook is configured.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target,
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection|null $changeDetection = null,
        Mode|string|null $mode = null,
        Schedule|array|null $schedule = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorNewResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'target' => $target,
                'changeDetection' => $changeDetection,
                'mode' => $mode,
                'schedule' => $schedule,
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
     * Retrieve a monitor’s configuration and current state.
     *
     * @param string $monitorID ID of the monitor
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
     * Update a monitor. Changing its target or change detection replaces the baseline and queues a new baseline run.
     *
     * @param string $monitorID ID of the monitor
     * @param ChangeDetectionShape1 $changeDetection How changes are judged. Defaults to `semantic` for extract targets and page targets with `instructions`, otherwise `exact`.
     * @param string $name display name for the monitor
     * @param \ContextDev\Monitors\MonitorUpdateParams\Schedule|ScheduleShape1 $schedule Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     * @param Status|value-of<Status> $status set `paused` to stop scheduled runs or `active` to resume them
     * @param list<string> $tags labels for filtering monitors, their changes, and their usage
     * @param TargetShape1 $target what to watch: a page, a sitemap, or data extracted from a site
     * @param \ContextDev\Monitors\MonitorUpdateParams\Webhook|WebhookShape1|null $webhook Set to null to remove the webhook. Changing `url` issues a new secret.
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
     * List your monitors with optional search and filters.
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType filter by change detection type
     * @param string $cursor opaque pagination cursor from a previous response
     * @param int $limit Maximum number of items to return per page (1-100). Defaults to 25.
     * @param string $q free-text search term, matched against the fields named in `search_by`
     * @param list<SearchBy|value-of<SearchBy>>|null $searchBy Fields to search with `q`. Defaults to all fields; page and extract targets can have instructions.
     * @param SearchType|value-of<SearchType> $searchType `prefix` for as-you-type prefix matching (default), `exact` for full-token matching
     * @param \ContextDev\Monitors\MonitorListParams\Status|value-of<\ContextDev\Monitors\MonitorListParams\Status> $status filter monitors by lifecycle status
     * @param string $tag filter to items that have this tag
     * @param list<string>|null $tags comma-separated list of tags to filter by (matches monitors having any of them)
     * @param TargetType|value-of<TargetType> $targetType filter by target type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $q = null,
        ?array $searchBy = null,
        SearchType|string|null $searchType = null,
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
     * Delete a monitor and stop future runs and webhook retries.
     *
     * @param string $monitorID ID of the monitor
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
     * Return usage per monitor, highest first, for up to the 10,000 most recent runs in the requested window.
     *
     * @param \DateTimeInterface $since only include items at or after this ISO 8601 timestamp
     * @param \DateTimeInterface $until only include items before this ISO 8601 timestamp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCreditUsage(
        ?\DateTimeInterface $since = null,
        ?\DateTimeInterface $until = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorGetCreditUsageResponse {
        $params = Util::removeNulls(['since' => $since, 'until' => $until]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getCreditUsage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve your organization’s monitor allowance and usage.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getLimits(
        RequestOptions|array|null $requestOptions = null
    ): MonitorGetLimitsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getLimits(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List full change records across your monitors, newest first.
     *
     * @param \ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType|value-of<\ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType> $changeDetectionType filter by change detection type
     * @param string $cursor opaque pagination cursor from a previous response
     * @param int $limit Maximum number of items to return per page (1-100). Defaults to 25.
     * @param string $monitorID filter changes to a single monitor
     * @param \DateTimeInterface $since only include items at or after this ISO 8601 timestamp
     * @param string $tag filter to items that have this tag
     * @param \ContextDev\Monitors\MonitorListAccountChangesParams\TargetType|value-of<\ContextDev\Monitors\MonitorListAccountChangesParams\TargetType> $targetType filter by target type
     * @param \DateTimeInterface $until only include items before this ISO 8601 timestamp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAccountChanges(
        \ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        ?int $limit = null,
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
     * List runs across your monitors, newest first.
     *
     * @param string $cursor opaque pagination cursor from a previous response
     * @param int $limit Maximum number of items to return per page (1-100). Defaults to 25.
     * @param \ContextDev\Monitors\MonitorListAccountRunsParams\Status|value-of<\ContextDev\Monitors\MonitorListAccountRunsParams\Status> $status filter runs by lifecycle status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listAccountRuns(
        ?string $cursor = null,
        ?int $limit = null,
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
     * List full change records for a monitor, newest first.
     *
     * @param string $monitorID ID of the monitor
     * @param string $cursor opaque pagination cursor from a previous response
     * @param int $limit Maximum number of items to return per page (1-100). Defaults to 25.
     * @param \DateTimeInterface $since only include items at or after this ISO 8601 timestamp
     * @param string $tag filter to items that have this tag
     * @param \DateTimeInterface $until only include items before this ISO 8601 timestamp
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listChanges(
        string $monitorID,
        ?string $cursor = null,
        ?int $limit = null,
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
     * List a monitor’s runs, newest first.
     *
     * @param string $monitorID ID of the monitor
     * @param string $cursor opaque pagination cursor from a previous response
     * @param int $limit Maximum number of items to return per page (1-100). Defaults to 25.
     * @param \ContextDev\Monitors\MonitorListRunsParams\Status|value-of<\ContextDev\Monitors\MonitorListRunsParams\Status> $status filter runs by lifecycle status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listRuns(
        string $monitorID,
        ?string $cursor = null,
        ?int $limit = null,
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
     * Retrieve a detected change, including its diff and available evidence.
     *
     * @param string $changeID ID of the detected change
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
     * Retrieve the status, timing, and results of one monitor run.
     *
     * @param string $runID ID of the monitor run
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveRun(
        string $runID,
        string $monitorID,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorGetRunResponse {
        $params = Util::removeNulls(['monitorID' => $monitorID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveRun($runID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Generate and return a new signing secret. It takes effect immediately for all subsequent delivery attempts.
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateWebhookSecret(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorRotateWebhookSecretResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotateWebhookSecret($monitorID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Queue a run without changing the regular schedule. Paused monitors return 409.
     *
     * @param string $monitorID ID of the monitor
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
