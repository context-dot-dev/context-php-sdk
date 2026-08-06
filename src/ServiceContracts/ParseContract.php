<?php

declare(strict_types=1);

namespace ContextDev\ServiceContracts;

use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\IncludeImages\UnionMember1;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleParams\Zdr;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;

/**
 * @phpstan-import-type IncludeImagesShape from \ContextDev\Parse\ParseHandleParams\IncludeImages
 * @phpstan-import-type IncludeLinksShape from \ContextDev\Parse\ParseHandleParams\IncludeLinks
 * @phpstan-import-type OcrShape from \ContextDev\Parse\ParseHandleParams\Ocr
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
 * @phpstan-import-type ShortenBase64ImagesShape from \ContextDev\Parse\ParseHandleParams\ShortenBase64Images
 * @phpstan-import-type UseMainContentOnlyShape from \ContextDev\Parse\ParseHandleParams\UseMainContentOnly
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
     * @param IncludeImagesShape $includeImages Query param: Include image references in Markdown output
     * @param IncludeLinksShape $includeLinks Query param: Preserve hyperlinks in Markdown output
     * @param OcrShape $ocr Query param: When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdf.start/pdf.end limit the inclusive page range. When false, no OCR runs.
     * @param Pdf|PdfShape $pdf Query param: PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
     * @param ShortenBase64ImagesShape $shortenBase64Images Query param: Shorten base64-encoded image data in the Markdown output
     * @param list<string> $tags Query param: Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     * @param UseMainContentOnlyShape $useMainContentOnly Query param: Extract only the main content from HTML-like inputs
     * @param Zdr|value-of<Zdr> $zdr Query param: Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function handle(
        string|FileParam $body,
        ?string $client = null,
        Extension|string|null $extension = null,
        bool|UnionMember1|string $includeImages = false,
        bool|\ContextDev\Parse\ParseHandleParams\IncludeLinks\UnionMember1|string $includeLinks = true,
        bool|\ContextDev\Parse\ParseHandleParams\Ocr\UnionMember1|string $ocr = false,
        Pdf|array $pdf = (object) [],
        bool|\ContextDev\Parse\ParseHandleParams\ShortenBase64Images\UnionMember1|string $shortenBase64Images = true,
        ?array $tags = null,
        bool|\ContextDev\Parse\ParseHandleParams\UseMainContentOnly\UnionMember1|string $useMainContentOnly = false,
        Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse;
}
