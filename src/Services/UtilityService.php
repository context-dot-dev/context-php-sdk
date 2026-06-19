<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\UtilityContract;
use ContextDev\Utility\UtilityPrefetchByEmailResponse;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class UtilityService implements UtilityContract
{
    /**
     * @api
     */
    public UtilityRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UtilityRawService($client);
    }

    /**
     * @api
     *
     * Signal that you may fetch brand data for a particular domain soon to improve latency.
     *
     * @param string $domain Domain name to prefetch brand data for
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function prefetch(
        string $domain,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): UtilityPrefetchResponse {
        $params = Util::removeNulls(
            ['domain' => $domain, 'timeoutMs' => $timeoutMs]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->prefetch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Signal that you may fetch brand data for a particular domain soon to improve latency. This endpoint accepts an email address, extracts the domain from it, validates that it's not a disposable or free email provider, and queues the domain for prefetching.
     *
     * @param string $email Email address to prefetch brand data for. The domain will be extracted from the email. Free email providers (gmail.com, yahoo.com, etc.) and disposable email addresses are not allowed.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function prefetchByEmail(
        string $email,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): UtilityPrefetchByEmailResponse {
        $params = Util::removeNulls(['email' => $email, 'timeoutMs' => $timeoutMs]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->prefetchByEmail(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
