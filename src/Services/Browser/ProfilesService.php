<?php

declare(strict_types=1);

namespace ContextDev\Services\Browser;

use ContextDev\Browser\Profiles\ProfileListResponse;
use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\Browser\ProfilesContract;

/**
 * See the authenticated browser profiles your organization created.
 *
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class ProfilesService implements ProfilesContract
{
    /**
     * @api
     */
    public ProfilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProfilesRawService($client);
    }

    /**
     * @api
     *
     * List the browser profiles your organization created with `/web/scrape`, newest first.
     *
     * @param string $cursor the `next_cursor` from the previous page
     * @param int $limit number of profiles per page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        int $limit = 25,
        RequestOptions|array|null $requestOptions = null,
    ): ProfileListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
