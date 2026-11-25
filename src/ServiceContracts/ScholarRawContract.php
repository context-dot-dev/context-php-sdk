<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Scholar\ScholarSearchParams;
use ContextDev\Scholar\ScholarSearchResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ScholarRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ScholarSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ScholarSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|ScholarSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
