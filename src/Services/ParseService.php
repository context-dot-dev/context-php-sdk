<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\Core\Exceptions\APIException;
use ContextDev\Core\FileParam;
use ContextDev\Core\Util;
use ContextDev\Parse\ParseHandleParams\Extension;
use ContextDev\Parse\ParseHandleParams\Pdf;
use ContextDev\Parse\ParseHandleParams\Zdr;
use ContextDev\Parse\ParseHandleResponse;
use ContextDev\RequestOptions;
use ContextDev\ServiceContracts\ParseContract;

/**
 * Convert uploaded files, such as PDFs and Office documents, into Markdown.
 *
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
     * Convert a file to Markdown. Handles PDF, Word, Excel, PowerPoint, HTML, XML, CSV, JSON, YAML, source code, subtitles, images, and WARC archives. Send the raw bytes as the request body; set `ocr=true` to read scanned pages and images.
     *
     * @param string|FileParam $body Body param
     * @param string $client query param: Client identifier for usage attribution
     * @param Extension|value-of<Extension> $extension Query param: File type hint, such as `pdf`, `docx`, `xlsx`, `pptx`, `html`, `json`, `csv`, `md`, `py`, `rtf`, `jpg`, `png`, `txt`, `warc`, or `warc.gz`. Use it when the `Content-Type` header is missing or generic.
     * @param bool $includeImages query param: Include image references in the Markdown
     * @param bool $includeLinks query param: Keep link URLs in the Markdown
     * @param bool $includeNumberedPages query param: Start each PDF page in the Markdown with a `<!-- page N -->` line, where `N` is the original 1-based page number
     * @param bool $ocr Query param: Read text from images and scanned PDF pages with OCR, within the `pdf` page range. Adds 1 credit per page read.
     * @param Pdf|PdfShape $pdf query param: PDF page range as a JSON object, such as `{"start": 2, "end": 5}`
     * @param bool $shortenBase64Images query param: Shorten inline base64 image data
     * @param list<string> $tags Query param: Comma-separated labels for this request, such as `production,team-alpha`. Filter usage and request logs by them.
     * @param bool $useMainContentOnly Query param: Keep only the main content, without navigation, headers, footers, or sidebars. Applies to HTML-like inputs.
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
        bool $includeNumberedPages = false,
        bool $ocr = false,
        Pdf|array|null $pdf = null,
        bool $shortenBase64Images = true,
        ?array $tags = null,
        bool $useMainContentOnly = false,
        Zdr|string $zdr = 'disabled',
        RequestOptions|array|null $requestOptions = null,
    ): ParseHandleResponse {
        $params = Util::removeNulls(
            [
                'client' => $client,
                'extension' => $extension,
                'includeImages' => $includeImages,
                'includeLinks' => $includeLinks,
                'includeNumberedPages' => $includeNumberedPages,
                'ocr' => $ocr,
                'pdf' => $pdf,
                'shortenBase64Images' => $shortenBase64Images,
                'tags' => $tags,
                'useMainContentOnly' => $useMainContentOnly,
                'zdr' => $zdr,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->handle($body, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
