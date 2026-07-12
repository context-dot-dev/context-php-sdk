<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Parse\ParseHandleParams;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ParseRawContract
{
    /**
     * @api
     *
     * @param string|FileParam $body Body param
     * @param array<string,mixed>|ParseHandleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ParseHandleResponse>
     *
     * @throws APIException
     */
    public function handle(
        string|FileParam $body,
        array|ParseHandleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
