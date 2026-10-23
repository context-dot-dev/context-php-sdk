<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\People\PersonEnrichParams;
use ContextDev\People\PersonEnrichResponse;
use ContextDev\People\PersonSearchParams;
use ContextDev\People\PersonSearchResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface PeopleRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PersonEnrichParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PersonEnrichResponse>
     *
     * @throws APIException
     */
    public function enrich(
        array|PersonEnrichParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PersonSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PersonSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|PersonSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
