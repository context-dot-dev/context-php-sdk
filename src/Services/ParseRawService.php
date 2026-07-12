<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Contracts\BaseResponse;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Parse\ParseHandleParams;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\ParseRawContract;

/**
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class ParseRawService implements ParseRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown. The base request costs 1 credit. When OCR runs (requires ocr=true), the entire call costs 5 credits; ocr=true requests where no OCR ends up running still cost 1 credit.
     *
     * @param string|FileParam $body Body param
     * @param array{
     *   extension?: value-of<Extension>,
     *   includeImages?: bool,
     *   includeLinks?: bool,
     *   ocr?: bool,
     *   pdf?: Pdf|PdfShape,
     *   shortenBase64Images?: bool,
     *   useMainContentOnly?: bool,
     * }|ParseHandleParams $params
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
    ): BaseResponse {
        [$parsed, $options] = ParseHandleParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'parse',
            query: array_diff_key($parsed, array_flip(['body'])),
            headers: ['Content-Type' => 'application/octet-stream'],
            body: $parsed,
            options: $options,
            convert: ParseHandleResponse::class,
        );
    }
}
