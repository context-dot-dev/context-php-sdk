<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts\Browser;

use ContextDev\Browser\Profiles\ProfileListParams;
use ContextDev\Browser\Profiles\ProfileListResponse;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ProfilesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProfileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ProfileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
