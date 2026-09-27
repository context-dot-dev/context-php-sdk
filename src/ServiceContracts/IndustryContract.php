<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts;
use ContextDev\Industry\IndustryRetrieveNaicsParams\Zdr;
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
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts request deadline and what to return when it passes
     * @param Zdr|value-of<Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
        Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): IndustryGetNaicsResponse;

    /**
     * @api
     *
     * @param string $input Brand domain or title to retrieve SIC code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     * @param int $maxResults Maximum number of SIC codes to return. Must be between 1 and 10. Defaults to 5.
     * @param int $minResults Minimum number of SIC codes to return. Must be at least 1. Defaults to 1.
     * @param list<string> $tags Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts|TimeoutOptsShape1 $timeoutOpts request deadline and what to return when it passes
     * @param Type|value-of<Type> $type SIC dataset: `original_sic` (1987) or `latest_sec` (current SEC list)
     * @param \ContextDev\Industry\IndustryRetrieveSicParams\Zdr|value-of<\ContextDev\Industry\IndustryRetrieveSicParams\Zdr> $zdr `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
        \ContextDev\Industry\IndustryRetrieveSicParams\Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): IndustryGetSicResponse;
}
