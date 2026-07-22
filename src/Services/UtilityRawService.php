<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\UtilityRawContract;
use ContextDev\Utility\UtilityPrefetchParams;
use ContextDev\Utility\UtilityPrefetchParams\Type;
use ContextDev\Utility\UtilityPrefetchResponse;

/**
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
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
     * Signal that you may fetch brand data soon to improve latency. The type field selects what to prefetch (currently only 'brand') and identifier carries exactly one lookup key: a domain, or an email whose domain is extracted and validated (free email providers and disposable email addresses are not allowed).
     *
     * @param array{
     *   identifier: IdentifierShape,
     *   type: Type|value-of<Type>,
     *   tags?: list<string>,
     *   timeoutMs?: int,
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
