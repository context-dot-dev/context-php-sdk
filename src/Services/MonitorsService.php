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
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsSearchTarget;
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
 * Watch websites on a schedule for exact or meaningful changes.
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
     * Watch a web page, a sitemap, data extracted from a site, or web search results on a schedule, and get a webhook when something changes. Creating a monitor queues its baseline run right away.
     *
     * @param string $name display name for the monitor
     * @param TargetShape $target what to watch: a page, a sitemap, data extracted from a site, or web search results
     * @param ChangeDetectionShape $changeDetection How changes are judged. Defaults to `semantic` for extract and search targets and for page targets with `instructions`; otherwise `exact`. Sitemap targets support only `exact`, and extract targets only `semantic`.
     * @param Mode|value-of<Mode> $mode Monitor category. Always `web`.
     * @param list<string> $policies Access policy IDs to apply to every run. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param Schedule|ScheduleShape $schedule Run the monitor at a fixed interval, such as every 6 hours or every 2 days. The interval must be between 10 minutes and 1 year.
     * @param list<string> $tags Labels for grouping monitors. Filter monitors, changes, and credit usage by tag.
     * @param Webhook|WebhookShape|null $webhook Webhook that receives monitor events. `null` when no webhook is configured.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget $target,
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection|null $changeDetection = null,
        Mode|string|null $mode = null,
        ?array $policies = null,
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
                'policies' => $policies,
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
     * Retrieve a monitor's configuration, status, and current baseline.
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
     * Change a monitor's settings, or pause and resume it. Changing the target or change detection replaces the baseline and queues a new baseline run.
     *
     * @param string $monitorID ID of the monitor
     * @param ChangeDetectionShape1 $changeDetection How changes are judged. Defaults to `semantic` for extract and search targets and for page targets with `instructions`; otherwise `exact`. Sitemap targets support only `exact`, and extract targets only `semantic`.
     * @param string $name display name for the monitor
     * @param list<string> $policies Access policy IDs to apply to every run, or an empty list to remove them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param \ContextDev\Monitors\MonitorUpdateParams\Schedule|ScheduleShape1 $schedule Run the monitor at a fixed interval, such as every 6 hours or every 2 days. The interval must be between 10 minutes and 1 year.
     * @param Status|value-of<Status> $status Set `paused` to stop scheduled runs or `active` to resume them. A resumed monitor runs promptly instead of waiting a full interval.
     * @param list<string> $tags Labels for grouping monitors. Filter monitors, changes, and credit usage by tag.
     * @param TargetShape1 $target what to watch: a page, a sitemap, data extracted from a site, or web search results
     * @param \ContextDev\Monitors\MonitorUpdateParams\Webhook|WebhookShape1|null $webhook Set to `null` to remove the webhook. Changing `url` generates a new secret.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $monitorID,
        \ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsExactChangeDetection|array|\ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsSemanticChangeDetection|null $changeDetection = null,
        ?string $name = null,
        ?array $policies = null,
        \ContextDev\Monitors\MonitorUpdateParams\Schedule|array|null $schedule = null,
        Status|string|null $status = null,
        ?array $tags = null,
        \ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsPageTarget|array|\ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget|\ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsExtractTarget|\ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSearchTarget|null $target = null,
        \ContextDev\Monitors\MonitorUpdateParams\Webhook|array|null $webhook = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorUpdateResponse {
        $params = Util::removeNulls(
            [
                'changeDetection' => $changeDetection,
                'name' => $name,
                'policies' => $policies,
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
     * List your monitors, newest first. Search by name, URL, or instructions, and filter by status, target type, detection type, or tags.
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType filter by change detection type
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit Maximum number of monitors to return per page. Defaults to 25.
     * @param string $q text to search for in the fields listed in `search_by`
     * @param list<SearchBy|value-of<SearchBy>>|null $searchBy Comma-separated fields to search with `q`. Defaults to all fields. For search targets, `url` matches the target's `query`.
     * @param SearchType|value-of<SearchType> $searchType How `q` matches. `prefix` matches the start of words and tolerates one typo, for search as you type; `exact` matches whole words only. Defaults to `prefix`.
     * @param \ContextDev\Monitors\MonitorListParams\Status|value-of<\ContextDev\Monitors\MonitorListParams\Status> $status filter by monitor status
     * @param list<string>|null $tags Comma-separated tags. Returns monitors that have any of them.
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
     * Delete a monitor along with its runs, changes, and baseline. Future runs and pending webhook retries stop.
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
     * List credits charged per monitor, highest first, from up to the 10,000 most recent runs in the time window. Pass `tag` to report on one group of monitors, such as a single customer's.
     *
     * @param \DateTimeInterface $since count only runs created at or after this time
     * @param string $tag Return usage only for monitors that currently have this tag. Deleted monitors are excluded.
     * @param \DateTimeInterface $until count only runs created at or before this time
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getCreditUsage(
        ?\DateTimeInterface $since = null,
        ?string $tag = null,
        ?\DateTimeInterface $until = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorGetCreditUsageResponse {
        $params = Util::removeNulls(
            ['since' => $since, 'tag' => $tag, 'until' => $until]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getCreditUsage(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve how many monitors your organization has and how many your plan allows.
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
     * List detected changes across all your monitors, newest first. Filter by monitor, target type, detection type, tag, or time range.
     *
     * @param \ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType|value-of<\ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType> $changeDetectionType filter by change detection type
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit Maximum number of changes to return per page. Defaults to 25.
     * @param string $monitorID return only changes from this monitor
     * @param \DateTimeInterface $since return only changes detected at or after this time
     * @param string $tag return only changes that have this tag
     * @param \ContextDev\Monitors\MonitorListAccountChangesParams\TargetType|value-of<\ContextDev\Monitors\MonitorListAccountChangesParams\TargetType> $targetType filter by target type
     * @param \DateTimeInterface $until return only changes detected at or before this time
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
     * List runs across all your monitors, newest first.
     *
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit Maximum number of runs to return per page. Defaults to 25.
     * @param \ContextDev\Monitors\MonitorListAccountRunsParams\Status|value-of<\ContextDev\Monitors\MonitorListAccountRunsParams\Status> $status filter by run status
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
     * List a monitor's detected changes, newest first. Each change includes its full diff and evidence.
     *
     * @param string $monitorID ID of the monitor
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit Maximum number of changes to return per page. Defaults to 25.
     * @param \DateTimeInterface $since return only changes detected at or after this time
     * @param string $tag return only changes that have this tag
     * @param \DateTimeInterface $until return only changes detected at or before this time
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
     * List a monitor's runs, newest first.
     *
     * @param string $monitorID ID of the monitor
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit Maximum number of runs to return per page. Defaults to 25.
     * @param \ContextDev\Monitors\MonitorListRunsParams\Status|value-of<\ContextDev\Monitors\MonitorListRunsParams\Status> $status filter by run status
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
     * Retrieve a detected change with its summary, diff, URLs, and evidence.
     *
     * @param string $changeID ID of the change
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
     * Retrieve a run's status, timing, credit charge, and webhook deliveries. If the run found a change, `change_id` points to it.
     *
     * @param string $runID ID of the run
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
     * Replace the monitor's webhook signing secret. The new secret signs every delivery attempt from now on, including retries.
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
     * Queue a run now without changing the monitor's schedule. Returns the run ID to poll. Paused monitors return `409`.
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
