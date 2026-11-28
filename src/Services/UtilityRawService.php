<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\UtilityRawContract;
use ContextDev\Utility\UtilityPrefetchParams;
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
     * Start fetching a domain's brand or styleguide data in the background so a later lookup returns faster. Accepts a domain or a work email.
     *
     * @param array{
     *   identifier: IdentifierShape,
     *   type: Type|value-of<Type>,
     *   policies?: list<string>,
     *   tags?: list<string>,
     *   timeoutOpts?: TimeoutOpts|TimeoutOptsShape,
     * }|UtilityPrefetchParams $params
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
            path: 'utility/prefetch',
            body: (object) $parsed,
            options: $options,
            convert: UtilityPrefetchResponse::class,
        );
    }
}
