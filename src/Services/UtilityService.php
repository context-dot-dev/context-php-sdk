<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\UtilityContract;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchDomainIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchEmailIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts;
use ContextDev\Utility\UtilityPrefetchParams\Type;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * Prefetch brand and styleguide data so later lookups return sooner.
 *
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts
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
     * Start fetching a domain's brand or styleguide data in the background so a later lookup returns faster. Accepts a domain or a work email.
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
    ): UtilityPrefetchResponse {
        $params = Util::removeNulls(
            [
                'identifier' => $identifier,
                'type' => $type,
                'policies' => $policies,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->prefetch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
