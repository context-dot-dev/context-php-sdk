<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data;

use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Metadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * A page the batch fetched successfully.
 *
 * @phpstan-import-type MetadataShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Metadata
 *
 * @phpstan-type ScrapedPageShape = array{
 *   finalURL: string,
 *   httpStatus: int|null,
 *   metadata: Metadata|MetadataShape,
 *   status: 'ok',
 *   url: string,
 *   html?: string|null,
 *   itemID?: string|null,
 *   markdown?: string|null,
 *   meta?: array<string,mixed>|null,
 *   ocrPages?: int|null,
 * }
 */
final class ScrapedPage implements BaseModel
{
    /** @use SdkModel<ScrapedPageShape> */
    use SdkModel;

    /**
     * The page was scraped.
     *
     * @var 'ok' $status
     */
    #[Required]
    public string $status = 'ok';

    /**
     * URL the content was read from, after redirects.
     */
    #[Required('final_url')]
    public string $finalURL;

    /**
     * HTTP status of the final response, when known.
     */
    #[Required('http_status')]
    public ?int $httpStatus;

    /**
     * Metadata extracted from the scraped page HTML.
     */
    #[Required]
    public Metadata $metadata;

    /**
     * URL as submitted, or as discovered by the crawl.
     */
    #[Required]
    public string $url;

    /**
     * Page HTML. Present on html batches, and on markdown batches submitted with `options.includeHTML`.
     */
    #[Optional]
    public ?string $html;

    /**
     * Caller-supplied identifier echoed from submission.
     */
    #[Optional('itemId')]
    public ?string $itemID;

    /**
     * Page content as Markdown. Present on markdown batches.
     */
    #[Optional]
    public ?string $markdown;

    /**
     * Caller-supplied metadata echoed from submission.
     *
     * @var array<string,mixed>|null $meta
     */
    #[Optional(map: 'mixed')]
    public ?array $meta;

    /**
     * PDF pages of this document recovered by OCR (pdf.ocr=true). Each recovered page bills 1 credit on top of the page base credit; absent when no OCR ran.
     */
    #[Optional('ocr_pages')]
    public ?int $ocrPages;

    /**
     * `new ScrapedPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ScrapedPage::with(finalURL: ..., httpStatus: ..., metadata: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ScrapedPage)
     *   ->withFinalURL(...)
     *   ->withHTTPStatus(...)
     *   ->withMetadata(...)
     *   ->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Metadata|MetadataShape $metadata
     * @param array<string,mixed>|null $meta
     */
    public static function with(
        string $finalURL,
        ?int $httpStatus,
        Metadata|array $metadata,
        string $url,
        ?string $html = null,
        ?string $itemID = null,
        ?string $markdown = null,
        ?array $meta = null,
        ?int $ocrPages = null,
    ): self {
        $self = new self;

        $self['finalURL'] = $finalURL;
        $self['httpStatus'] = $httpStatus;
        $self['metadata'] = $metadata;
        $self['url'] = $url;

        null !== $html && $self['html'] = $html;
        null !== $itemID && $self['itemID'] = $itemID;
        null !== $markdown && $self['markdown'] = $markdown;
        null !== $meta && $self['meta'] = $meta;
        null !== $ocrPages && $self['ocrPages'] = $ocrPages;

        return $self;
    }

    /**
     * URL the content was read from, after redirects.
     */
    public function withFinalURL(string $finalURL): self
    {
        $self = clone $this;
        $self['finalURL'] = $finalURL;

        return $self;
    }

    /**
     * HTTP status of the final response, when known.
     */
    public function withHTTPStatus(?int $httpStatus): self
    {
        $self = clone $this;
        $self['httpStatus'] = $httpStatus;

        return $self;
    }

    /**
     * Metadata extracted from the scraped page HTML.
     *
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * The page was scraped.
     *
     * @param 'ok' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * URL as submitted, or as discovered by the crawl.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Page HTML. Present on html batches, and on markdown batches submitted with `options.includeHTML`.
     */
    public function withHTML(string $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * Caller-supplied identifier echoed from submission.
     */
    public function withItemID(string $itemID): self
    {
        $self = clone $this;
        $self['itemID'] = $itemID;

        return $self;
    }

    /**
     * Page content as Markdown. Present on markdown batches.
     */
    public function withMarkdown(string $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Caller-supplied metadata echoed from submission.
     *
     * @param array<string,mixed> $meta
     */
    public function withMeta(array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

        return $self;
    }

    /**
     * PDF pages of this document recovered by OCR (pdf.ocr=true). Each recovered page bills 1 credit on top of the page base credit; absent when no OCR ran.
     */
    public function withOcrPages(int $ocrPages): self
    {
        $self = clone $this;
        $self['ocrPages'] = $ocrPages;

        return $self;
    }
}
