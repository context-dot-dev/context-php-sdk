<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use ContextDev\Industry\IndustryRetrieveSicParams\Type;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface IndustryContract
{
    /**
     * @api
     *
     * @param string $input Brand domain or title to retrieve NAICS code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     * @param int $maxResults Maximum number of NAICS codes to return. Must be between 1 and 10. Defaults to 5.
     * @param int $minResults Minimum number of NAICS codes to return. Must be at least 1. Defaults to 1.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveNaics(
        string $input,
        int $maxResults = 5,
        int $minResults = 1,
        ?int $timeoutMs = null,
        RequestOptions|array|null $requestOptions = null,
    ): IndustryGetNaicsResponse;

    /**
     * @api
     *
     * @param string $input Brand domain or title to retrieve SIC code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     * @param int $maxResults Maximum number of SIC codes to return. Must be between 1 and 10. Defaults to 5.
     * @param int $minResults Minimum number of SIC codes to return. Must be at least 1. Defaults to 1.
     * @param int $timeoutMs Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     * @param Type|value-of<Type> $type Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSic(
        string $input,
        int $maxResults = 5,
        int $minResults = 1,
        ?int $timeoutMs = null,
        Type|string $type = 'original_sic',
        RequestOptions|array|null $requestOptions = null,
    ): IndustryGetSicResponse;
}
