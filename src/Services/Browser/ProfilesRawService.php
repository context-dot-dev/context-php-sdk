<?php

declare(strict_types=1);

namespace ContextDev\Services\Browser;

use ContextDev\Browser\Profiles\ProfileListParams;
use ContextDev\Browser\Profiles\ProfileListResponse;
use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\Browser\ProfilesRawContract;

/**
 * See the authenticated browser profiles your organization created.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class ProfilesRawService implements ProfilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List the browser profiles your organization created with `/web/scrape`, newest first.
     *
     * @param array{cursor?: string, limit?: int}|ProfileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ProfileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProfileListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'org/browser/profiles',
            query: $parsed,
            options: $options,
            convert: ProfileListResponse::class,
        );
    }
}
