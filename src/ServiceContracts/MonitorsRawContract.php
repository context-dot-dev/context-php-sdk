<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Monitors\MonitorCreateParams;
use ContextDev\Monitors\MonitorDeleteResponse;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsExtractSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange;
use ContextDev\Monitors\MonitorListAccountChangesParams;
use ContextDev\Monitors\MonitorListAccountChangesResponse;
use ContextDev\Monitors\MonitorListAccountRunsParams;
use ContextDev\Monitors\MonitorListAccountRunsResponse;
use ContextDev\Monitors\MonitorListChangesParams;
use ContextDev\Monitors\MonitorListChangesResponse;
use ContextDev\Monitors\MonitorListParams;
use ContextDev\Monitors\MonitorListResponse;
use ContextDev\Monitors\MonitorListRunsParams;
use ContextDev\Monitors\MonitorListRunsResponse;
use ContextDev\Monitors\MonitorNewResponse\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsSitemapExactMonitor;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateParams;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface MonitorsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MonitorCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor,>
     *
     * @throws APIException
     */
    public function create(
        array|MonitorCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<\ContextDev\Monitors\MonitorGetResponse\MonitorsPageExactMonitor|\ContextDev\Monitors\MonitorGetResponse\MonitorsSitemapExactMonitor|\ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor|\ContextDev\Monitors\MonitorGetResponse\MonitorsExtractSemanticMonitor,>
     *
     * @throws APIException
     */
    public function retrieve(
        string $monitorID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MonitorUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<\ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageExactMonitor|\ContextDev\Monitors\MonitorUpdateResponse\MonitorsSitemapExactMonitor|\ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageSemanticMonitor|\ContextDev\Monitors\MonitorUpdateResponse\MonitorsExtractSemanticMonitor,>
     *
     * @throws APIException
     */
    public function update(
        string $monitorID,
        array|MonitorUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MonitorListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|MonitorListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MonitorListAccountChangesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListAccountChangesResponse>
     *
     * @throws APIException
     */
    public function listAccountChanges(
        array|MonitorListAccountChangesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MonitorListAccountRunsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MonitorListAccountRunsResponse>
     *
     * @throws APIException
     */
    public function listAccountRuns(
        array|MonitorListAccountRunsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MonitorListChangesParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MonitorListRunsParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
