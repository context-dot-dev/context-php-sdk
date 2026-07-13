<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Core\Util;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\ParseContract;

/**
 * @phpstan-import-type PdfShape from \ContextDev\Parse\ParseHandleParams\Pdf
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
     * Converts raw text, source code, web/data, PDF, Microsoft Office, and image bytes into LLM-usable Markdown. The base request costs 1 credit. When OCR runs (requires ocr=true), the entire call costs 5 credits; ocr=true requests where no OCR ends up running still cost 1 credit.
     *
     * @param string|FileParam $body Body param
     * @param Extension|value-of<Extension> $extension Query param: Optional file extension hint. Case-insensitive; a leading dot is accepted (e.g. ".pdf").
     * @param bool $includeImages Query param: Include image references in Markdown output
     * @param bool $includeLinks Query param: Preserve hyperlinks in Markdown output
     * @param bool $ocr Query param: Gates all OCR. When true, PDFs get embedded-image OCR (recognized text inserted at each image's position in page reading order, preserving the text layer; pdf.start/pdf.end limit the page range), scanned PDFs with no text layer get full-document OCR, and raster images get their visible text transcribed. When false, no OCR runs: scanned PDFs may yield no content and images return only format/dimension metadata. Calls where OCR actually runs cost 5 credits instead of 1.
     * @param Pdf|PdfShape $pdf Query param: PDF page-range controls. Use start/end to limit parsing (and OCR when ocr=true) to an inclusive 1-based page range.
     * @param bool $shortenBase64Images Query param: Shorten base64-encoded image data in the Markdown output
     * @param list<string> $tags Query param: Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
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
        ?array $tags = null,
        bool $useMainContentOnly = false,
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse {
        $params = Util::removeNulls(
            [
                'extension' => $extension,
                'includeImages' => $includeImages,
                'includeLinks' => $includeLinks,
                'ocr' => $ocr,
                'pdf' => $pdf,
                'shortenBase64Images' => $shortenBase64Images,
                'tags' => $tags,
                'useMainContentOnly' => $useMainContentOnly,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->handle($body, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
