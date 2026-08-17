<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\News\NewsSearchParams;
use ContextDev\News\NewsSearchResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface NewsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|NewsSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NewsSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|NewsSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
