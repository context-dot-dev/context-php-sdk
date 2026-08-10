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
use ContextDev\Utility\UtilityPrefetchParams\Type;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
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
     * Signal that you may fetch data soon to improve latency. The type field selects what to prefetch ('brand' queues a brand data fetch, 'styleguide' queues a styleguide extraction) and identifier carries exactly one lookup key: a domain, or an email whose domain is extracted and validated (free email providers and disposable email addresses are not allowed).
     *
     * @param IdentifierShape $identifier Identifier of the target to prefetch. Provide exactly one of domain or email.
     * @param Type|value-of<Type> $type what to prefetch: 'brand' warms the brand data cache, 'styleguide' warms the styleguide cache
     * @param list<string> $tags Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function prefetch(
        UtilityPrefetchDomainIdentifier|array|UtilityPrefetchEmailIdentifier $identifier,
        Type|string $type,
        ?array $tags = null,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): UtilityPrefetchResponse {
        $params = Util::removeNulls(
            [
                'identifier' => $identifier,
                'type' => $type,
                'tags' => $tags,
                'timeoutMs' => $timeoutMs,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->prefetch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
