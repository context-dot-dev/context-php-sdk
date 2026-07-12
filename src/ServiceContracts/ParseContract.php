<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ParseContract
{
    /**
     * @api
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
    ): ParseHandleResponse;
}
