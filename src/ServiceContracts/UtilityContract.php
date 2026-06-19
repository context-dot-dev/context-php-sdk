<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Utility\UtilityPrefetchByEmailResponse;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface UtilityContract
{
    /**
     * @api
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
    ): UtilityPrefetchResponse;

    /**
     * @api
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
    ): UtilityPrefetchByEmailResponse;
}
