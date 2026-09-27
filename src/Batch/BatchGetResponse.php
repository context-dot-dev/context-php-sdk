<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchGetResponse\Credits;
use ContextDev\Batch\BatchGetResponse\Format;
use ContextDev\Batch\BatchGetResponse\InvalidURL;
use ContextDev\Batch\BatchGetResponse\KeyMetadata;
use ContextDev\Batch\BatchGetResponse\Mode;
use ContextDev\Batch\BatchGetResponse\Progress;
use ContextDev\Batch\BatchGetResponse\Results;
use ContextDev\Batch\BatchGetResponse\Status;
use ContextDev\Batch\BatchGetResponse\Timing;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CrawlControlsShape from \ContextDev\Batch\CrawlControls
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchGetResponse\Credits
 * @phpstan-import-type FailureShape from \ContextDev\Batch\Failure
 * @phpstan-import-type IntakeShape from \ContextDev\Batch\Intake
 * @phpstan-import-type InvalidURLShape from \ContextDev\Batch\BatchGetResponse\InvalidURL
 * @phpstan-import-type PageErrorCountShape from \ContextDev\Batch\PageErrorCount
 * @phpstan-import-type ProgressShape from \ContextDev\Batch\BatchGetResponse\Progress
 * @phpstan-import-type ResultsShape from \ContextDev\Batch\BatchGetResponse\Results
 * @phpstan-import-type TimingShape from \ContextDev\Batch\BatchGetResponse\Timing
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchGetResponse\KeyMetadata
 *
 * @phpstan-type BatchGetResponseShape = array{
 *   id: string,
 *   crawl: null|CrawlControls|CrawlControlsShape,
 *   credits: Credits|CreditsShape,
 *   failure: null|Failure|FailureShape,
 *   format: Format|value-of<Format>,
 *   input: Intake|IntakeShape,
 *   invalidURLs: list<InvalidURL|InvalidURLShape>,
 *   mode: Mode|value-of<Mode>,
 *   pageErrors: list<PageErrorCount|PageErrorCountShape>,
 *   progress: Progress|ProgressShape,
 *   requestID: string,
 *   results: null|Results|ResultsShape,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   timing: Timing|TimingShape,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   webhookDeliveryID?: string|null,
 * }
 */
final class BatchGetResponse implements BaseModel
{
    /** @use SdkModel<BatchGetResponseShape> */
    use SdkModel;

    /**
     * Batch ID.
     */
    #[Required]
    public string $id;

    /**
     * Crawl settings as submitted.
     */
    #[Required]
    public ?CrawlControls $crawl;

    /**
     * Batch credit usage and settlement.
     */
    #[Required]
    public Credits $credits;

    /**
     * A failure of the batch as a whole, distinct from the per-page failures in `page_errors`.
     */
    #[Required]
    public ?Failure $failure;

    /**
     * What each page is returned as. Matches `input.data.format` on the submit request.
     *
     * @var value-of<Format> $format
     */
    #[Required(enum: Format::class)]
    public string $format;

    /**
     * What the submission accepted.
     */
    #[Required]
    public Intake $input;

    /**
     * Rejected URLs (first 100).
     *
     * @var list<InvalidURL> $invalidURLs
     */
    #[Required('invalid_urls', list: InvalidURL::class)]
    public array $invalidURLs;

    /**
     * `scrape` (URL list) or `crawl`.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Individual page failures grouped by error code, sorted by count. Unrelated to `failure`, which is the batch itself failing.
     *
     * @var list<PageErrorCount> $pageErrors
     */
    #[Required('page_errors', list: PageErrorCount::class)]
    public array $pageErrors;

    /**
     * Pages attempted so far. Use `status` to check completion.
     */
    #[Required]
    public Progress $progress;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Result download links; null until the batch finishes. Files are deleted 7 days after the batch finishes.
     */
    #[Required]
    public ?Results $results;

    /**
     * Current state. `completed`, `cancelled`, and `failed` are final.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Tags stored on the batch at submission.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    #[Required]
    public Timing $timing;

    /**
     * API key usage for this request.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Batch completion delivery ID, when available.
     */
    #[Optional('webhook_delivery_id')]
    public ?string $webhookDeliveryID;

    /**
     * `new BatchGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchGetResponse::with(
     *   id: ...,
     *   crawl: ...,
     *   credits: ...,
     *   failure: ...,
     *   format: ...,
     *   input: ...,
     *   invalidURLs: ...,
     *   mode: ...,
     *   pageErrors: ...,
     *   progress: ...,
     *   requestID: ...,
     *   results: ...,
     *   status: ...,
     *   tags: ...,
     *   timing: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchGetResponse)
     *   ->withID(...)
     *   ->withCrawl(...)
     *   ->withCredits(...)
     *   ->withFailure(...)
     *   ->withFormat(...)
     *   ->withInput(...)
     *   ->withInvalidURLs(...)
     *   ->withMode(...)
     *   ->withPageErrors(...)
     *   ->withProgress(...)
     *   ->withRequestID(...)
     *   ->withResults(...)
     *   ->withStatus(...)
     *   ->withTags(...)
     *   ->withTiming(...)
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
     * @param CrawlControls|CrawlControlsShape|null $crawl
     * @param Credits|CreditsShape $credits
     * @param Failure|FailureShape|null $failure
     * @param Format|value-of<Format> $format
     * @param Intake|IntakeShape $input
     * @param list<InvalidURL|InvalidURLShape> $invalidURLs
     * @param Mode|value-of<Mode> $mode
     * @param list<PageErrorCount|PageErrorCountShape> $pageErrors
     * @param Progress|ProgressShape $progress
     * @param Results|ResultsShape|null $results
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param Timing|TimingShape $timing
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $id,
        CrawlControls|array|null $crawl,
        Credits|array $credits,
        Failure|array|null $failure,
        Format|string $format,
        Intake|array $input,
        array $invalidURLs,
        Mode|string $mode,
        array $pageErrors,
        Progress|array $progress,
        string $requestID,
        Results|array|null $results,
        Status|string $status,
        array $tags,
        Timing|array $timing,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $webhookDeliveryID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['crawl'] = $crawl;
        $self['credits'] = $credits;
        $self['failure'] = $failure;
        $self['format'] = $format;
        $self['input'] = $input;
        $self['invalidURLs'] = $invalidURLs;
        $self['mode'] = $mode;
        $self['pageErrors'] = $pageErrors;
        $self['progress'] = $progress;
        $self['requestID'] = $requestID;
        $self['results'] = $results;
        $self['status'] = $status;
        $self['tags'] = $tags;
        $self['timing'] = $timing;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $webhookDeliveryID && $self['webhookDeliveryID'] = $webhookDeliveryID;

        return $self;
    }

    /**
     * Batch ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Crawl settings as submitted.
     *
     * @param CrawlControls|CrawlControlsShape|null $crawl
     */
    public function withCrawl(CrawlControls|array|null $crawl): self
    {
        $self = clone $this;
        $self['crawl'] = $crawl;

        return $self;
    }

    /**
     * Batch credit usage and settlement.
     *
     * @param Credits|CreditsShape $credits
     */
    public function withCredits(Credits|array $credits): self
    {
        $self = clone $this;
        $self['credits'] = $credits;

        return $self;
    }

    /**
     * A failure of the batch as a whole, distinct from the per-page failures in `page_errors`.
     *
     * @param Failure|FailureShape|null $failure
     */
    public function withFailure(Failure|array|null $failure): self
    {
        $self = clone $this;
        $self['failure'] = $failure;

        return $self;
    }

    /**
     * What each page is returned as. Matches `input.data.format` on the submit request.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * What the submission accepted.
     *
     * @param Intake|IntakeShape $input
     */
    public function withInput(Intake|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Rejected URLs (first 100).
     *
     * @param list<InvalidURL|InvalidURLShape> $invalidURLs
     */
    public function withInvalidURLs(array $invalidURLs): self
    {
        $self = clone $this;
        $self['invalidURLs'] = $invalidURLs;

        return $self;
    }

    /**
     * `scrape` (URL list) or `crawl`.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Individual page failures grouped by error code, sorted by count. Unrelated to `failure`, which is the batch itself failing.
     *
     * @param list<PageErrorCount|PageErrorCountShape> $pageErrors
     */
    public function withPageErrors(array $pageErrors): self
    {
        $self = clone $this;
        $self['pageErrors'] = $pageErrors;

        return $self;
    }

    /**
     * Pages attempted so far. Use `status` to check completion.
     *
     * @param Progress|ProgressShape $progress
     */
    public function withProgress(Progress|array $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Result download links; null until the batch finishes. Files are deleted 7 days after the batch finishes.
     *
     * @param Results|ResultsShape|null $results
     */
    public function withResults(Results|array|null $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Current state. `completed`, `cancelled`, and `failed` are final.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Tags stored on the batch at submission.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * @param Timing|TimingShape $timing
     */
    public function withTiming(Timing|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }

    /**
     * API key usage for this request.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Batch completion delivery ID, when available.
     */
    public function withWebhookDeliveryID(string $webhookDeliveryID): self
    {
        $self = clone $this;
        $self['webhookDeliveryID'] = $webhookDeliveryID;

        return $self;
    }
}
