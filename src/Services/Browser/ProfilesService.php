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
 * List the authenticated browser profiles your organization created.
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
     * List the browser profiles your organization saved through `POST /web/scrape`, newest first. Pass a profile `id` as `sharedParams.profile.profileId` to scrape as that signed-in user.
     *
     * @param string $cursor Cursor from the previous page's `next_cursor`. Omit for the first page.
     * @param int $limit maximum number of profiles to return per page
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
