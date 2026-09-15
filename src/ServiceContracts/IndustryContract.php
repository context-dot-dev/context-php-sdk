<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts;
use ContextDev\Industry\IndustryRetrieveSicParams\Type;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts as TimeoutOptsShape1
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
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveNaics(
        string $input,
        int $maxResults = 5,
        int $minResults = 1,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        RequestOptions|array|null $requestOptions = null,
    ): IndustryGetNaicsResponse;

    /**
     * @api
     *
     * @param string $input Brand domain or title to retrieve SIC code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     * @param int $maxResults Maximum number of SIC codes to return. Must be between 1 and 10. Defaults to 5.
     * @param int $minResults Minimum number of SIC codes to return. Must be at least 1. Defaults to 1.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts|TimeoutOptsShape1 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param Type|value-of<Type> $type Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSic(
        string $input,
        int $maxResults = 5,
        int $minResults = 1,
        ?array $tags = null,
        \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts|array|null $timeoutOpts = null,
        Type|string $type = 'original_sic',
        RequestOptions|array|null $requestOptions = null,
    ): IndustryGetSicResponse;
}
