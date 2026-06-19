<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\Util;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use ContextDev\Industry\IndustryRetrieveNaicsParams;
use ContextDev\Industry\IndustryRetrieveSicParams;
use ContextDev\Industry\IndustryRetrieveSicParams\Type;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\IndustryRawContract;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class IndustryRawService implements IndustryRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Classify any brand into 2022 NAICS industry codes from its domain or name.
     *
     * @param array{
     *   input: string, maxResults?: int, minResults?: int, timeoutMs?: int
     * }|IndustryRetrieveNaicsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IndustryGetNaicsResponse>
     *
     * @throws APIException
     */
    public function retrieveNaics(
        array|IndustryRetrieveNaicsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = IndustryRetrieveNaicsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/naics',
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: IndustryGetNaicsResponse::class,
        );
    }

    /**
     * @api
     *
     * Classify any brand into Standard Industrial Classification (SIC) codes from its domain or name. Choose between the original SIC system (`original_sic`) or the latest SIC list maintained by the SEC (`latest_sec`).
     *
     * @param array{
     *   input: string,
     *   maxResults?: int,
     *   minResults?: int,
     *   timeoutMs?: int,
     *   type?: Type|value-of<Type>,
     * }|IndustryRetrieveSicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IndustryGetSicResponse>
     *
     * @throws APIException
     */
    public function retrieveSic(
        array|IndustryRetrieveSicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = IndustryRetrieveSicParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'web/sic',
            query: Util::array_transform_keys($parsed, ['timeoutMs' => 'timeoutMS']),
            options: $options,
            convert: IndustryGetSicResponse::class,
        );
    }
}
