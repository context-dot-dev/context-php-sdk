<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts;
use ContextDev\Industry\IndustryRetrieveNaicsParams\Zdr;
use ContextDev\Industry\IndustryRetrieveSicParams\Type;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\IndustryContract;

/**
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Industry\IndustryRetrieveNaicsParams\TimeoutOpts
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts as TimeoutOptsShape1
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class IndustryService implements IndustryContract
{
    /**
     * @api
     */
    public IndustryRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new IndustryRawService($client);
    }

    /**
     * @api
     *
     * Classify any brand into 2022 NAICS industry codes from its domain or name.
     *
     * @param string $input Brand domain or title to retrieve NAICS code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     * @param int $maxResults Maximum number of NAICS codes to return. Must be between 1 and 10. Defaults to 5.
     * @param int $minResults Minimum number of NAICS codes to return. Must be at least 1. Defaults to 1.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param Zdr|value-of<Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
    ): IndustryGetNaicsResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'maxResults' => $maxResults,
                'minResults' => $minResults,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveNaics(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Classify any brand into Standard Industrial Classification (SIC) codes from its domain or name. Choose between the original SIC system (`original_sic`) or the latest SIC list maintained by the SEC (`latest_sec`).
     *
     * @param string $input Brand domain or title to retrieve SIC code for. If a valid domain is provided, it will be used for classification, otherwise, we will search for the brand using the provided title.
     * @param int $maxResults Maximum number of SIC codes to return. Must be between 1 and 10. Defaults to 5.
     * @param int $minResults Minimum number of SIC codes to return. Must be at least 1. Defaults to 1.
     * @param list<string> $tags Comma-separated tags for tracking request usage. Up to 20 tags, each 1-50 characters.
     * @param \ContextDev\Industry\IndustryRetrieveSicParams\TimeoutOpts|TimeoutOptsShape1 $timeoutOpts Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     * @param Type|value-of<Type> $type Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
     * @param \ContextDev\Industry\IndustryRetrieveSicParams\Zdr|value-of<\ContextDev\Industry\IndustryRetrieveSicParams\Zdr> $zdr Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
    ): IndustryGetSicResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'maxResults' => $maxResults,
                'minResults' => $minResults,
                'tags' => $tags,
                'timeoutOpts' => $timeoutOpts,
                'type' => $type,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveSic(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
