<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchDomainIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchEmailIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts;
use ContextDev\Utility\UtilityPrefetchParams\Type;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface UtilityContract
{
    /**
     * @api
     *
     * @param IdentifierShape $identifier Domain or work email to prefetch. Provide exactly one.
     * @param Type|value-of<Type> $type data to prefetch
     * @param list<string> $policies Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     * @param list<string> $tags Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts Request deadline. The request fails with 408 when it passes.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function prefetch(
        UtilityPrefetchDomainIdentifier|array|UtilityPrefetchEmailIdentifier $identifier,
        Type|string $type,
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        RequestOptions|array|null $requestOptions = null,
    ): UtilityPrefetchResponse;
}
