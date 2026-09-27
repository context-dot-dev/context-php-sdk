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
     * @param bool $ocr Query param: Read text from images and scanned PDF pages. PDF page ranges still apply.
     * @param Pdf|PdfShape $pdf Query param: PDF page-range options as a JSON object, e.g. {"start": 2, "end": 5}.
     * @param bool $shortenBase64Images Query param: Shorten base64-encoded image data in the Markdown output
     * @param list<string> $tags Query param: Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     * @param bool $useMainContentOnly Query param: Extract only the main content from HTML-like inputs
     * @param Zdr|value-of<Zdr> $zdr Query param: `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
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
        Pdf|array|null $pdf = null,
        bool $shortenBase64Images = true,
        ?array $tags = null,
        bool $useMainContentOnly = false,
        Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse;
}
