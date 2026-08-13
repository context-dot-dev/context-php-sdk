<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleParams\Zdr;
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
     * @param string $client query param: Optional client identifier used for usage attribution
     * @param Extension|value-of<Extension> $extension query param: Optional file extension hint, such as pdf, docx, xlsx, pptx, html, json, csv, md, py, rtf, jpg, png, or txt
     * @param bool $includeImages Query param: Include image references in Markdown output
     * @param bool $includeLinks Query param: Preserve hyperlinks in Markdown output
     * @param bool $ocr Query param: When true for PDF inputs, OCR the selected pages that have no usable text layer (scans), replacing each recovered page's text with the OCR result while pages with a real text layer keep it. pdf.start/pdf.end limit the inclusive page range. Billed at 1 credit per page OCR actually recovered, on top of the base request cost. When false, no OCR runs.
     * @param Pdf|PdfShape $pdf Query param: PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
     * @param bool $shortenBase64Images Query param: Shorten base64-encoded image data in the Markdown output
     * @param list<string> $tags Query param: Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param bool $useMainContentOnly Query param: Extract only the main content from HTML-like inputs
     * @param Zdr|value-of<Zdr> $zdr Query param: Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function handle(
        string|FileParam $body,
        ?string $client = null,
        Extension|string|null $extension = null,
        bool $includeImages = false,
        bool $includeLinks = true,
        bool $ocr = false,
        Pdf|array $pdf = (object) [],
        bool $shortenBase64Images = true,
        ?array $tags = null,
        bool $useMainContentOnly = false,
        Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse;
}
