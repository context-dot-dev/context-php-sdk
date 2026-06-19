<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\UtilityRawContract;
use ContextDev\Utility\UtilityPrefetchByEmailParams;
use ContextDev\Utility\UtilityPrefetchByEmailResponse;
use ContextDev\Utility\UtilityPrefetchParams;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class UtilityRawService implements UtilityRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Signal that you may fetch brand data for a particular domain soon to improve latency.
     *
     * @param array{domain: string, timeoutMs?: int}|UtilityPrefetchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UtilityPrefetchResponse>
     *
     * @throws APIException
     */
    public function prefetch(
        array|UtilityPrefetchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UtilityPrefetchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brand/prefetch',
            body: (object) $parsed,
            options: $options,
            convert: UtilityPrefetchResponse::class,
        );
    }

    /**
     * @api
     *
     * Signal that you may fetch brand data for a particular domain soon to improve latency. This endpoint accepts an email address, extracts the domain from it, validates that it's not a disposable or free email provider, and queues the domain for prefetching.
     *
     * @param array{
     *   email: string, timeoutMs?: int
     * }|UtilityPrefetchByEmailParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UtilityPrefetchByEmailResponse>
     *
     * @throws APIException
     */
    public function prefetchByEmail(
        array|UtilityPrefetchByEmailParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UtilityPrefetchByEmailParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brand/prefetch-by-email',
            body: (object) $parsed,
            options: $options,
            convert: UtilityPrefetchByEmailResponse::class,
        );
    }
}
