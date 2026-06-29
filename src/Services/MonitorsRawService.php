<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Monitors\MonitorCreateParams;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\Schedule;
use ContextDev\Monitors\MonitorCreateParams\Target;
use ContextDev\Monitors\MonitorCreateParams\Webhook;
use ContextDev\Monitors\MonitorDeleteResponse;
use ContextDev\Monitors\MonitorGetChangeResponse;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsExtractSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange;
use ContextDev\Monitors\MonitorGetResponse;
use ContextDev\Monitors\MonitorListAccountChangesParams;
use ContextDev\Monitors\MonitorListAccountChangesResponse;
use ContextDev\Monitors\MonitorListAccountRunsParams;
use ContextDev\Monitors\MonitorListAccountRunsResponse;
use ContextDev\Monitors\MonitorListChangesParams;
use ContextDev\Monitors\MonitorListChangesResponse;
use ContextDev\Monitors\MonitorListParams;
use ContextDev\Monitors\MonitorListParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListParams\TargetType;
use ContextDev\Monitors\MonitorListResponse;
use ContextDev\Monitors\MonitorListRunsParams;
use ContextDev\Monitors\MonitorListRunsResponse;
use ContextDev\Monitors\MonitorNewResponse;
use ContextDev\Monitors\MonitorNewResponse\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsSitemapExactMonitor;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateParams;
use ContextDev\Monitors\MonitorUpdateParams\Status;
use ContextDev\Monitors\MonitorUpdateResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\MonitorsRawContract;

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
final class MonitorsRawService implements MonitorsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a monitor. The request body is a union of the supported target/change detection combinations. The monitor runs immediately after creation to create its initial baseline.
     *
     * @param array{
     *   changeDetection: ChangeDetection|ChangeDetectionShape,
     *   name: string,
     *   schedule: Schedule|ScheduleShape,
     *   target: Target|TargetShape,
     *   tags?: list<string>,
     *   webhook?: Webhook|WebhookShape|null,
     * }|MonitorCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor,>
     *
     * @throws APIException
     */
    public function create(
        array|MonitorCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'monitors',
            body: (object) $parsed,
            options: $options,
            convert: MonitorNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a monitor
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorGetResponse\MonitorsPageExactMonitor|MonitorGetResponse\MonitorsSitemapExactMonitor|MonitorGetResponse\MonitorsPageSemanticMonitor|MonitorGetResponse\MonitorsExtractSemanticMonitor,>
     *
     * @throws APIException
     */
    public function retrieve(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['monitors/%1$s', $monitorID],
            options: $requestOptions,
            convert: MonitorGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Updates a monitor. If `target` or `change_detection` changes, the monitor creates a new baseline. Unsupported target/change detection combinations are rejected.
     *
     * @param array{
     *   changeDetection?: ChangeDetectionShape1,
     *   name?: string,
     *   schedule?: MonitorUpdateParams\Schedule|ScheduleShape1,
     *   status?: Status|value-of<Status>,
     *   tags?: list<string>,
     *   target?: TargetShape1,
     *   webhook?: MonitorUpdateParams\Webhook|WebhookShape1|null,
     * }|MonitorUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorUpdateResponse\MonitorsPageExactMonitor|MonitorUpdateResponse\MonitorsSitemapExactMonitor|MonitorUpdateResponse\MonitorsPageSemanticMonitor|MonitorUpdateResponse\MonitorsExtractSemanticMonitor,>
     *
     * @throws APIException
     */
    public function update(
        string $monitorID,
        array|MonitorUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['monitors/%1$s', $monitorID],
            body: (object) $parsed,
            options: $options,
            convert: MonitorUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * List monitors
     *
     * @param array{
     *   changeDetectionType?: ChangeDetectionType|value-of<ChangeDetectionType>,
     *   cursor?: string,
     *   limit?: int,
     *   status?: MonitorListParams\Status|value-of<MonitorListParams\Status>,
     *   tag?: string,
     *   targetType?: TargetType|value-of<TargetType>,
     * }|MonitorListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|MonitorListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'monitors',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'changeDetectionType' => 'change_detection_type',
                    'targetType' => 'target_type',
                ],
            ),
            options: $options,
            convert: MonitorListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a monitor
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['monitors/%1$s', $monitorID],
            options: $requestOptions,
            convert: MonitorDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns an account-wide feed of detected changes across monitors.
     *
     * @param array{
     *   changeDetectionType?: MonitorListAccountChangesParams\ChangeDetectionType|value-of<MonitorListAccountChangesParams\ChangeDetectionType>,
     *   cursor?: string,
     *   limit?: int,
     *   monitorID?: string,
     *   since?: \DateTimeInterface,
     *   tag?: string,
     *   targetType?: MonitorListAccountChangesParams\TargetType|value-of<MonitorListAccountChangesParams\TargetType>,
     *   until?: \DateTimeInterface,
     * }|MonitorListAccountChangesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListAccountChangesResponse>
     *
     * @throws APIException
     */
    public function listAccountChanges(
        array|MonitorListAccountChangesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorListAccountChangesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'monitors/changes',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'changeDetectionType' => 'change_detection_type',
                    'monitorID' => 'monitor_id',
                    'targetType' => 'target_type',
                ],
            ),
            options: $options,
            convert: MonitorListAccountChangesResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns an account-wide feed of monitor runs across all monitors.
     *
     * @param array{
     *   cursor?: string,
     *   limit?: int,
     *   status?: MonitorListAccountRunsParams\Status|value-of<MonitorListAccountRunsParams\Status>,
     * }|MonitorListAccountRunsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListAccountRunsResponse>
     *
     * @throws APIException
     */
    public function listAccountRuns(
        array|MonitorListAccountRunsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorListAccountRunsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'monitors/runs',
            query: $parsed,
            options: $options,
            convert: MonitorListAccountRunsResponse::class,
        );
    }

    /**
     * @api
     *
     * List changes for a monitor
     *
     * @param array{
     *   cursor?: string,
     *   limit?: int,
     *   since?: \DateTimeInterface,
     *   tag?: string,
     *   until?: \DateTimeInterface,
     * }|MonitorListChangesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListChangesResponse>
     *
     * @throws APIException
     */
    public function listChanges(
        string $monitorID,
        array|MonitorListChangesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorListChangesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['monitors/%1$s/changes', $monitorID],
            query: $parsed,
            options: $options,
            convert: MonitorListChangesResponse::class,
        );
    }

    /**
     * @api
     *
     * List monitor runs
     *
     * @param array{
     *   cursor?: string,
     *   limit?: int,
     *   status?: MonitorListRunsParams\Status|value-of<MonitorListRunsParams\Status>,
     * }|MonitorListRunsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListRunsResponse>
     *
     * @throws APIException
     */
    public function listRuns(
        string $monitorID,
        array|MonitorListRunsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorListRunsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['monitors/%1$s/runs', $monitorID],
            query: $parsed,
            options: $options,
            convert: MonitorListRunsResponse::class,
        );
    }

    /**
     * @api
     *
     * Get a change
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorsPageExactChange|MonitorsSitemapExactChange|MonitorsPageSemanticChange|MonitorsExtractSemanticChange,>
     *
     * @throws APIException
     */
    public function retrieveChange(
        string $changeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['monitors/changes/%1$s', $changeID],
            options: $requestOptions,
            convert: MonitorGetChangeResponse::class,
        );
    }

    /**
     * @api
     *
     * Triggers an immediate run of the monitor outside its normal schedule. The run is queued and processed asynchronously.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorRunResponse>
     *
     * @throws APIException
     */
    public function run(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['monitors/%1$s/run', $monitorID],
            options: $requestOptions,
            convert: MonitorRunResponse::class,
        );
    }
}
