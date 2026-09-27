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
     * Queue brand or styleguide data so a later lookup can return sooner.
     *
     * @param IdentifierShape $identifier Identifier of the target to prefetch. Provide exactly one of domain or email.
     * @param Type|value-of<Type> $type data to prefetch
     * @param list<string> $tags labels for filtering usage in the dashboard
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function prefetch(
        UtilityPrefetchDomainIdentifier|array|UtilityPrefetchEmailIdentifier $identifier,
        Type|string $type,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        RequestOptions|array|null $requestOptions = null,
    ): UtilityPrefetchResponse {
        $params = Util::removeNulls(
            [
                'identifier' => $identifier,
                'type' => $type,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->prefetch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
