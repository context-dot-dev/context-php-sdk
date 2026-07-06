<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Utility\UtilityPrefetchParams\Identifier;
use ContextDev\Utility\UtilityPrefetchParams\Type;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface UtilityContract
{
    /**
     * @api
     *
     * @param Identifier|IdentifierShape $identifier Identifier of the brand to prefetch. Provide exactly one of domain or email.
     * @param Type|value-of<Type> $type What to prefetch. Currently only 'brand' is supported.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function prefetch(
        Identifier|array $identifier,
        Type|string $type,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): UtilityPrefetchResponse;
}
