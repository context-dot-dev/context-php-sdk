<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use ContextDev\Industry\IndustryRetrieveNaicsParams;
use ContextDev\Industry\IndustryRetrieveSicParams;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface IndustryRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|IndustryRetrieveNaicsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IndustryGetNaicsResponse>
     *
     * @throws APIException
     */
    public function retrieveNaics(
        array|IndustryRetrieveNaicsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|IndustryRetrieveSicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IndustryGetSicResponse>
     *
     * @throws APIException
     */
    public function retrieveSic(
        array|IndustryRetrieveSicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
