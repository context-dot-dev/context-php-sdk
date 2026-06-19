<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\RequestOptions;
use ContextDev\Web\WebExtractCompetitorsParams;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractFontsParams;
use ContextDev\Web\WebExtractFontsResponse;
use ContextDev\Web\WebExtractParams;
use ContextDev\Web\WebExtractResponse;
use ContextDev\Web\WebExtractStyleguideParams;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScreenshotParams;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchParams;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdParams;
use ContextDev\Web\WebWebCrawlMdResponse;
use ContextDev\Web\WebWebScrapeHTMLParams;
use ContextDev\Web\WebWebScrapeHTMLResponse;
use ContextDev\Web\WebWebScrapeImagesParams;
use ContextDev\Web\WebWebScrapeImagesResponse;
use ContextDev\Web\WebWebScrapeMdParams;
use ContextDev\Web\WebWebScrapeMdResponse;
use ContextDev\Web\WebWebScrapeSitemapParams;
use ContextDev\Web\WebWebScrapeSitemapResponse;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface WebRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        array|WebExtractParams $params,
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
     * @param array<string,mixed>|WebExtractFontsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebExtractFontsResponse>
     *
     * @throws APIException
     */
    public function extractFonts(
        array|WebExtractFontsParams $params,
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

    /**
     * @api
     *
     * @param array<string,mixed>|WebWebScrapeHTMLParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeHTMLResponse>
     *
     * @throws APIException
     */
    public function webScrapeHTML(
        array|WebWebScrapeHTMLParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebWebScrapeImagesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeImagesResponse>
     *
     * @throws APIException
     */
    public function webScrapeImages(
        array|WebWebScrapeImagesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebWebScrapeMdParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeMdResponse>
     *
     * @throws APIException
     */
    public function webScrapeMd(
        array|WebWebScrapeMdParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebWebScrapeSitemapParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebWebScrapeSitemapResponse>
     *
     * @throws APIException
     */
    public function webScrapeSitemap(
        array|WebWebScrapeSitemapParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
