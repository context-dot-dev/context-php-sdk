<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\Schedule;
use ContextDev\Monitors\MonitorCreateParams\Target;
use ContextDev\Monitors\MonitorCreateParams\Webhook;
use ContextDev\Monitors\MonitorDeleteResponse;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsExtractSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange;
use ContextDev\Monitors\MonitorListAccountChangesResponse;
use ContextDev\Monitors\MonitorListAccountRunsResponse;
use ContextDev\Monitors\MonitorListChangesResponse;
use ContextDev\Monitors\MonitorListParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListParams\TargetType;
use ContextDev\Monitors\MonitorListResponse;
use ContextDev\Monitors\MonitorListRunsResponse;
use ContextDev\Monitors\MonitorNewResponse\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsSitemapExactMonitor;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorUpdateParams\Status;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget;
use ContextDev\RequestOptions;

/**
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
interface MonitorsContract
{
    /**
     * @api
     *
     * @param ChangeDetection|ChangeDetectionShape $changeDetection detect meaning-level changes that match a natural language query
     * @param Schedule|ScheduleShape $schedule Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     * @param Target|TargetShape $target
     * @param list<string> $tags user-defined tags for grouping and filtering monitors and their changes
     * @param Webhook|WebhookShape|null $webhook
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ChangeDetection|array $changeDetection,
        string $name,
        Schedule|array $schedule,
        Target|array $target,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): \ContextDev\Monitors\MonitorGetResponse\MonitorsPageExactMonitor|\ContextDev\Monitors\MonitorGetResponse\MonitorsSitemapExactMonitor|\ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor|\ContextDev\Monitors\MonitorGetResponse\MonitorsExtractSemanticMonitor;

    /**
     * @api
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
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection|null $changeDetection = null,
        ?string $name = null,
        \ContextDev\Monitors\MonitorUpdateParams\Schedule|array|null $schedule = null,
        Status|string|null $status = null,
        ?array $tags = null,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget|null $target = null,
        \ContextDev\Monitors\MonitorUpdateParams\Webhook|array|null $webhook = null,
        RequestOptions|array|null $requestOptions = null,
    ): \ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageExactMonitor|\ContextDev\Monitors\MonitorUpdateResponse\MonitorsSitemapExactMonitor|\ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageSemanticMonitor|\ContextDev\Monitors\MonitorUpdateResponse\MonitorsExtractSemanticMonitor;

    /**
     * @api
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     * @param \ContextDev\Monitors\MonitorListParams\Status|value-of<\ContextDev\Monitors\MonitorListParams\Status> $status
     * @param string $tag filter to items that have this tag
     * @param TargetType|value-of<TargetType> $targetType
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        int $limit = 25,
        \ContextDev\Monitors\MonitorListParams\Status|string|null $status = null,
        ?string $tag = null,
        TargetType|string|null $targetType = null,
        RequestOptions|array|null $requestOptions = null,
    ): MonitorListResponse;

    /**
     * @api
     *
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
    ): MonitorListAccountChangesResponse;

    /**
     * @api
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
    ): MonitorListAccountRunsResponse;

    /**
     * @api
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
    ): MonitorListChangesResponse;

    /**
     * @api
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
    ): MonitorListRunsResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveChange(
        string $changeID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorsPageExactChange|MonitorsSitemapExactChange|MonitorsPageSemanticChange|MonitorsExtractSemanticChange;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function run(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): MonitorRunResponse;
}
