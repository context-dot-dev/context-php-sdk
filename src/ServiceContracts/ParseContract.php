<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 * @phpstan-import-type RequestOpts from \ContextDev\RequestOptions
 */
interface ParseContract
{
    /**
     * @api
     *
     * @param string|FileParam $body Body param
     * @param Extension|value-of<Extension> $extension Query param: Optional file extension hint. Case-insensitive; a leading dot is accepted (e.g. ".pdf").
     * @param bool $includeImages Query param: Include image references in Markdown output
     * @param bool $includeLinks Query param: Preserve hyperlinks in Markdown output
     * @param bool $ocr Query param: Gates all OCR. When true, PDFs get embedded-image OCR (recognized text inserted at each image's position in page reading order, preserving the text layer; pdf.start/pdf.end limit the page range), scanned PDFs with no text layer get full-document OCR, and raster images get their visible text transcribed. When false, no OCR runs: scanned PDFs may yield no content and images return only format/dimension metadata. Calls where OCR actually runs cost 5 credits instead of 1.
     * @param Pdf|PdfShape $pdf Query param: PDF page-range controls. Use start/end to limit parsing (and OCR when ocr=true) to an inclusive 1-based page range.
     * @param bool $shortenBase64Images Query param: Shorten base64-encoded image data in the Markdown output
     * @param bool $useMainContentOnly Query param: Extract only the main content from HTML-like inputs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function handle(
        string|FileParam $body,
        Extension|string|null $extension = null,
        bool $includeImages = false,
        bool $includeLinks = true,
        bool $ocr = false,
        Pdf|array $pdf = (object) [],
        bool $shortenBase64Images = true,
        bool $useMainContentOnly = false,
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse;
}
