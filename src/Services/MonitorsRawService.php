<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Monitors\MonitorCreateParams;
use ContextDev\Monitors\MonitorCreateParams\Mode;
use ContextDev\Monitors\MonitorCreateParams\Schedule;
use ContextDev\Monitors\MonitorCreateParams\Webhook;
use ContextDev\Monitors\MonitorDeleteResponse;
use ContextDev\Monitors\MonitorGetChangeResponse;
use ContextDev\Monitors\MonitorGetCreditUsageParams;
use ContextDev\Monitors\MonitorGetCreditUsageResponse;
use ContextDev\Monitors\MonitorGetLimitsResponse;
use ContextDev\Monitors\MonitorGetResponse;
use ContextDev\Monitors\MonitorGetRunResponse;
use ContextDev\Monitors\MonitorListAccountChangesParams;
use ContextDev\Monitors\MonitorListAccountChangesResponse;
use ContextDev\Monitors\MonitorListAccountRunsParams;
use ContextDev\Monitors\MonitorListAccountRunsResponse;
use ContextDev\Monitors\MonitorListChangesParams;
use ContextDev\Monitors\MonitorListChangesResponse;
use ContextDev\Monitors\MonitorListParams;
use ContextDev\Monitors\MonitorListParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListParams\SearchBy;
use ContextDev\Monitors\MonitorListParams\SearchType;
use ContextDev\Monitors\MonitorListParams\TargetType;
use ContextDev\Monitors\MonitorListResponse;
use ContextDev\Monitors\MonitorListRunsParams;
use ContextDev\Monitors\MonitorListRunsResponse;
use ContextDev\Monitors\MonitorNewResponse;
use ContextDev\Monitors\MonitorRetrieveRunParams;
use ContextDev\Monitors\MonitorRotateWebhookSecretResponse;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateParams;
use ContextDev\Monitors\MonitorUpdateParams\Status;
use ContextDev\Monitors\MonitorUpdateResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\MonitorsRawContract;

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
     * Watch a web page, a sitemap, data extracted from a site, or web search results on a schedule, and get a webhook when something changes. Creating a monitor queues its baseline run right away.
     *
     * @param array{
     *   name: string,
     *   target: TargetShape,
     *   changeDetection?: ChangeDetectionShape,
     *   mode?: Mode|value-of<Mode>,
     *   policies?: list<string>,
     *   schedule?: Schedule|ScheduleShape,
     *   tags?: list<string>,
     *   webhook?: Webhook|WebhookShape|null,
     * }|MonitorCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorNewResponse>
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
     * Retrieve a monitor's configuration, status, and current baseline.
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorGetResponse>
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
     * Change a monitor's settings, or pause and resume it. Changing the target or change detection replaces the baseline and queues a new baseline run.
     *
     * @param string $monitorID ID of the monitor
     * @param array{
     *   changeDetection?: ChangeDetectionShape1,
     *   name?: string,
     *   policies?: list<string>,
     *   schedule?: MonitorUpdateParams\Schedule|ScheduleShape1,
     *   status?: Status|value-of<Status>,
     *   tags?: list<string>,
     *   target?: TargetShape1,
     *   webhook?: MonitorUpdateParams\Webhook|WebhookShape1|null,
     * }|MonitorUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorUpdateResponse>
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
     * List your monitors, newest first. Search by name, URL, or instructions, and filter by status, target type, detection type, or tags.
     *
     * @param array{
     *   changeDetectionType?: ChangeDetectionType|value-of<ChangeDetectionType>,
     *   cursor?: string,
     *   limit?: int,
     *   q?: string,
     *   searchBy?: list<SearchBy|value-of<SearchBy>>|null,
     *   searchType?: SearchType|value-of<SearchType>,
     *   status?: MonitorListParams\Status|value-of<MonitorListParams\Status>,
     *   tags?: list<string>|null,
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
                    'searchBy' => 'search_by',
                    'searchType' => 'search_type',
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
     * Delete a monitor along with its runs, changes, and baseline. Future runs and pending webhook retries stop.
     *
     * @param string $monitorID ID of the monitor
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
     * List credits charged per monitor, highest first, from up to the 10,000 most recent runs in the time window. Pass `tag` to report on one group of monitors, such as a single customer's.
     *
     * @param array{
     *   since?: \DateTimeInterface, tag?: string, until?: \DateTimeInterface
     * }|MonitorGetCreditUsageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorGetCreditUsageResponse>
     *
     * @throws APIException
     */
    public function getCreditUsage(
        array|MonitorGetCreditUsageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorGetCreditUsageParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'monitors/credit-usage',
            query: $parsed,
            options: $options,
            convert: MonitorGetCreditUsageResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve how many monitors your organization has and how many your plan allows.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorGetLimitsResponse>
     *
     * @throws APIException
     */
    public function getLimits(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'monitors/limits',
            options: $requestOptions,
            convert: MonitorGetLimitsResponse::class,
        );
    }

    /**
     * @api
     *
     * List detected changes across all your monitors, newest first. Filter by monitor, target type, detection type, tag, or time range.
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
     * List runs across all your monitors, newest first.
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
     * List a monitor's detected changes, newest first. Each change includes its full diff and evidence.
     *
     * @param string $monitorID ID of the monitor
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
     * List a monitor's runs, newest first.
     *
     * @param string $monitorID ID of the monitor
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
     * Retrieve a detected change with its summary, diff, URLs, and evidence.
     *
     * @param string $changeID ID of the change
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorGetChangeResponse>
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
     * Retrieve a run's status, timing, credit charge, and webhook deliveries. If the run found a change, `change_id` points to it.
     *
     * @param string $runID ID of the run
     * @param array{monitorID: string}|MonitorRetrieveRunParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorGetRunResponse>
     *
     * @throws APIException
     */
    public function retrieveRun(
        string $runID,
        array|MonitorRetrieveRunParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MonitorRetrieveRunParams::parseRequest(
            $params,
            $requestOptions,
        );
        $monitorID = $parsed['monitorID'];
        unset($parsed['monitorID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['monitors/%1$s/runs/%2$s', $monitorID, $runID],
            options: $options,
            convert: MonitorGetRunResponse::class,
        );
    }

    /**
     * @api
     *
     * Replace the monitor's webhook signing secret. The new secret signs every delivery attempt from now on, including retries.
     *
     * @param string $monitorID ID of the monitor
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorRotateWebhookSecretResponse>
     *
     * @throws APIException
     */
    public function rotateWebhookSecret(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['monitors/%1$s/webhook/rotate-secret', $monitorID],
            options: $requestOptions,
            convert: MonitorRotateWebhookSecretResponse::class,
        );
    }

    /**
     * @api
     *
     * Queue a run now without changing the monitor's schedule. Returns the run ID to poll. Paused monitors return `409`.
     *
     * @param string $monitorID ID of the monitor
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
