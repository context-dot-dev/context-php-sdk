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
 * @phpstan-import-type IncludeImagesShape from \ContextDev\Parse\ParseHandleParams\IncludeImages
 * @phpstan-import-type IncludeLinksShape from \ContextDev\Parse\ParseHandleParams\IncludeLinks
 * @phpstan-import-type OcrShape from \ContextDev\Parse\ParseHandleParams\Ocr
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 * @phpstan-import-type ShortenBase64ImagesShape from \ContextDev\Parse\ParseHandleParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyShape from \ContextDev\Parse\ParseHandleParams\UseMainContentOnly
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
     * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown.
     *
     * @param string|FileParam $body Body param
     * @param array{
     *   client?: string,
     *   extension?: value-of<Extension>,
     *   includeImages?: IncludeImagesShape,
     *   includeLinks?: IncludeLinksShape,
     *   ocr?: OcrShape,
     *   pdf?: Pdf|PdfShape,
     *   shortenBase64Images?: ShortenBase64ImagesShape,
     *   tags?: list<string>,
     *   useMainContentOnly?: UseMainContentOnlyShape,
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
