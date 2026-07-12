<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Core\Util;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\ParseContract;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
final class ParseService implements ParseContract
{
    /**
     * @api
     */
    public ParseRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ParseRawService($client);
    }

    /**
     * @api
     *
     * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown.
     *
     * @param string|FileParam $body Body param
     * @param string $baseURL Query param: Optional HTTP(S) source document URL used to resolve relative links and image references. Relative references remain relative when omitted.
     * @param string $extension query param: Optional file extension hint, such as pdf, docx, xlsx, pptx, html, json, csv, md, py, rtf, jpg, png, or txt
     * @param string $filename query param: Optional filename hint used to infer the extension when extension is omitted
     * @param bool $includeImages Query param: Include image references in Markdown output
     * @param bool $includeLinks Query param: Preserve hyperlinks in Markdown output
     * @param bool $ocr Query param: When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdfStart/pdfEnd limit the inclusive page range. This is separate from automatic scanned-PDF OCR fallback.
     * @param int $pdfEnd Query param: Last 1-based PDF page to parse. When omitted, parsing ends at the last page. Must be greater than or equal to pdfStart when both are provided.
     * @param int $pdfStart Query param: First 1-based PDF page to parse. When omitted, parsing starts at the first page.
     * @param bool $shortenBase64Images Query param: Shorten base64-encoded image data in the Markdown output
     * @param bool $useMainContentOnly Query param: Extract only the main content from HTML-like inputs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function handle(
        string|FileParam $body,
        ?string $baseURL = null,
        ?string $extension = null,
        ?string $filename = null,
        bool $includeImages = false,
        bool $includeLinks = true,
        bool $ocr = false,
        ?int $pdfEnd = null,
        ?int $pdfStart = null,
        bool $shortenBase64Images = true,
        bool $useMainContentOnly = false,
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse {
        $params = Util::removeNulls(
            [
                'baseURL' => $baseURL,
                'extension' => $extension,
                'filename' => $filename,
                'includeImages' => $includeImages,
                'includeLinks' => $includeLinks,
                'ocr' => $ocr,
                'pdfEnd' => $pdfEnd,
                'pdfStart' => $pdfStart,
                'shortenBase64Images' => $shortenBase64Images,
                'useMainContentOnly' => $useMainContentOnly,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->handle($body, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
