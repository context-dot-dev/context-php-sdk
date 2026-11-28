<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data;

use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * A page that could not be scraped.
 *
 * @phpstan-import-type ResultShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result
 *
 * @phpstan-type FailedPageShape = array{
 *   errorCode: string,
 *   message: string,
 *   status: 'error',
 *   url: string,
 *   creditsUsed?: int|null,
 *   itemID?: string|null,
 *   meta?: array<string,mixed>|null,
 *   ocrPages?: int|null,
 *   result?: null|Result|ResultShape,
 * }
 */
final class FailedPage implements BaseModel
{
    /** @use SdkModel<FailedPageShape> */
    use SdkModel;

    /**
     * The page could not be scraped.
     *
     * @var 'error' $status
     */
    #[Required]
    public string $status = 'error';

    /**
     * Machine-readable error code, such as `NOT_FOUND`.
     */
    #[Required('error_code')]
    public string $errorCode;

    /**
     * Human-readable explanation of the error.
     */
    #[Required]
    public string $message;

    /**
     * URL as submitted, or as discovered by the crawl.
     */
    #[Required]
    public string $url;

    /**
     * Credits charged for this page, including OCR. Cached results are priced the same as in `POST /web/scrape`.
     */
    #[Optional('credits_used')]
    public ?int $creditsUsed;

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
     * Per-format errors, when the scrape returned a response. Omitted when the page could not be scraped at all.
     */
    #[Optional]
    public ?Result $result;

    /**
     * `new FailedPage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FailedPage::with(errorCode: ..., message: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FailedPage)->withErrorCode(...)->withMessage(...)->withURL(...)
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
     * @param array<string,mixed>|null $meta
     * @param Result|ResultShape|null $result
     */
    public static function with(
        string $errorCode,
        string $message,
        string $url,
        ?int $creditsUsed = null,
        ?string $itemID = null,
        ?array $meta = null,
        ?int $ocrPages = null,
        Result|array|null $result = null,
    ): self {
        $self = new self;

        $self['errorCode'] = $errorCode;
        $self['message'] = $message;
        $self['url'] = $url;

        null !== $creditsUsed && $self['creditsUsed'] = $creditsUsed;
        null !== $itemID && $self['itemID'] = $itemID;
        null !== $meta && $self['meta'] = $meta;
        null !== $ocrPages && $self['ocrPages'] = $ocrPages;
        null !== $result && $self['result'] = $result;

        return $self;
    }

    /**
     * Machine-readable error code, such as `NOT_FOUND`.
     */
    public function withErrorCode(string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Human-readable explanation of the error.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * The page could not be scraped.
     *
     * @param 'error' $status
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
     * Credits charged for this page, including OCR. Cached results are priced the same as in `POST /web/scrape`.
     */
    public function withCreditsUsed(int $creditsUsed): self
    {
        $self = clone $this;
        $self['creditsUsed'] = $creditsUsed;

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

    /**
     * Per-format errors, when the scrape returned a response. Omitted when the page could not be scraped at all.
     *
     * @param Result|ResultShape $result
     */
    public function withResult(Result|array $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
