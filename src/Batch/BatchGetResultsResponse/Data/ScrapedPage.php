<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data;

use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * A page where at least one requested format succeeded. Check `result.isPartial` and each format's `success` for incomplete results.
 *
 * @phpstan-import-type ResultShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result
 *
 * @phpstan-type ScrapedPageShape = array{
 *   creditsUsed: int,
 *   result: Result|ResultShape,
 *   status: 'ok',
 *   url: string,
 *   itemID?: string|null,
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
     * Credits charged for this page, including OCR. Cached results are priced the same as in `POST /web/scrape`.
     */
    #[Required('credits_used')]
    public int $creditsUsed;

    /**
     * Scrape output, in the same shape as a `POST /web/scrape` response.
     */
    #[Required]
    public Result $result;

    /**
     * URL as submitted, or as discovered by the crawl.
     */
    #[Required]
    public string $url;

    /**
     * The `itemId` you submitted with this URL.
     */
    #[Optional('itemId')]
    public ?string $itemID;

    /**
     * The `meta` you submitted with this URL.
     *
     * @var array<string,mixed>|null $meta
     */
    #[Optional(map: 'mixed')]
    public ?array $meta;

    /**
     * Number of PDF pages read with OCR. Omitted when OCR did not run.
     */
    #[Optional('ocr_pages')]
    public ?int $ocrPages;

    /**
     * `new ScrapedPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ScrapedPage::with(creditsUsed: ..., result: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ScrapedPage)->withCreditsUsed(...)->withResult(...)->withURL(...)
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
     * @param Result|ResultShape $result
     * @param array<string,mixed>|null $meta
     */
    public static function with(
        int $creditsUsed,
        Result|array $result,
        string $url,
        ?string $itemID = null,
        ?array $meta = null,
        ?int $ocrPages = null,
    ): self {
        $self = new self;

        $self['creditsUsed'] = $creditsUsed;
        $self['result'] = $result;
        $self['url'] = $url;

        null !== $itemID && $self['itemID'] = $itemID;
        null !== $meta && $self['meta'] = $meta;
        null !== $ocrPages && $self['ocrPages'] = $ocrPages;

        return $self;
    }

    /**
     * Credits charged for this page, including OCR. Cached results are priced the same as in `POST /web/scrape`.
     */
    public function withCreditsUsed(int $creditsUsed): self
    {
        $self = clone $this;
        $self['creditsUsed'] = $creditsUsed;

        return $self;
    }

    /**
     * Scrape output, in the same shape as a `POST /web/scrape` response.
     *
     * @param Result|ResultShape $result
     */
    public function withResult(Result|array $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

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
     * The `itemId` you submitted with this URL.
     */
    public function withItemID(string $itemID): self
    {
        $self = clone $this;
        $self['itemID'] = $itemID;

        return $self;
    }

    /**
     * The `meta` you submitted with this URL.
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
     * Number of PDF pages read with OCR. Omitted when OCR did not run.
     */
    public function withOcrPages(int $ocrPages): self
    {
        $self = clone $this;
        $self['ocrPages'] = $ocrPages;

        return $self;
    }
}
