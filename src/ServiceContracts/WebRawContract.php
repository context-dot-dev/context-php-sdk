<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Web\WebAnswersParams;
use ContextDev\Web\WebAnswersResponse;
use ContextDev\Web\WebExtractCompetitorsParams;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractStyleguideParams;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebMapURLsParams;
use ContextDev\Web\WebMapURLsResponse;
use ContextDev\Web\WebScrapeParams;
use ContextDev\Web\WebScrapeResponse;
use ContextDev\Web\WebScreenshotParams;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdParams;
use ContextDev\Web\WebWebCrawlMdResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface WebRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebAnswersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebAnswersResponse>
     *
     * @throws APIException
     */
    public function answers(
        array|WebAnswersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebExtractCompetitorsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractCompetitorsResponse>
     *
     * @throws APIException
     */
    public function extractCompetitors(
        array|WebExtractCompetitorsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebExtractStyleguideParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractStyleguideResponse>
     *
     * @throws APIException
     */
    public function extractStyleguide(
        array|WebExtractStyleguideParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebMapURLsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebMapURLsResponse>
     *
     * @throws APIException
     */
    public function mapUrls(
        array|WebMapURLsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebScrapeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebScrapeResponse>
     *
     * @throws APIException
     */
    public function scrape(
        array|WebScrapeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebScreenshotParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebScreenshotResponse>
     *
     * @throws APIException
     */
    public function screenshot(
        array|WebScreenshotParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        array|WebSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebWebCrawlMdParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebCrawlMdResponse>
     *
     * @throws APIException
     */
    public function webCrawlMd(
        array|WebWebCrawlMdParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
