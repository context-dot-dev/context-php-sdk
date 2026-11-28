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
use ContextDev\Parse\ParseHandleParams\Zdr;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\ParseRawContract;

/**
 * Convert uploaded files, such as PDFs and Office documents, into Markdown.
 *
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
     * Convert a file to Markdown. Handles PDF, Word, Excel, PowerPoint, HTML, XML, CSV, JSON, YAML, source code, subtitles, images, and WARC archives. Send the raw bytes as the request body; set `ocr=true` to read scanned pages and images.
     *
     * @param string|FileParam $body Body param
     * @param array{
     *   client?: string,
     *   extension?: value-of<Extension>,
     *   includeImages?: bool,
     *   includeLinks?: bool,
     *   includeNumberedPages?: bool,
     *   ocr?: bool,
     *   pdf?: Pdf|PdfShape,
     *   shortenBase64Images?: bool,
     *   tags?: list<string>,
     *   useMainContentOnly?: bool,
     *   zdr?: Zdr|value-of<Zdr>,
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
