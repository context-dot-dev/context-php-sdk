<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts\Browser;

use ContextDev\Browser\Profiles\ProfileListResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ProfilesContract
{
    /**
     * @api
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
    ): ProfileListResponse;
}
