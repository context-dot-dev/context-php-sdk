<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
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

/**
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
interface MonitorsContract
{
    /**
     * @api
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
    ): MonitorNewResponse;

    /**
     * @api
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorGetResponse;

    /**
     * @api
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
    ): MonitorUpdateResponse;

    /**
     * @api
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
    ): MonitorListResponse;

    /**
     * @api
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorDeleteResponse;

    /**
     * @api
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
    ): MonitorGetCreditUsageResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getLimits(
        RequestOptions|array|null $requestOptions = null
    ): MonitorGetLimitsResponse;

    /**
     * @api
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
    ): MonitorListAccountChangesResponse;

    /**
     * @api
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
    ): MonitorListAccountRunsResponse;

    /**
     * @api
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
    ): MonitorListChangesResponse;

    /**
     * @api
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
    ): MonitorListRunsResponse;

    /**
     * @api
     *
     * @param string $changeID ID of the detected change
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveChange(
        string $changeID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorGetChangeResponse;

    /**
     * @api
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
    ): MonitorGetRunResponse;

    /**
     * @api
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateWebhookSecret(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorRotateWebhookSecretResponse;

    /**
     * @api
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function run(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorRunResponse;
}
