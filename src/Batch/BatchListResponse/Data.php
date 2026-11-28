<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse;

use ContextDev\Batch\BatchListResponse\Data\Credits;
use ContextDev\Batch\BatchListResponse\Data\Formats;
use ContextDev\Batch\BatchListResponse\Data\Mode;
use ContextDev\Batch\BatchListResponse\Data\Progress;
use ContextDev\Batch\BatchListResponse\Data\Results;
use ContextDev\Batch\BatchListResponse\Data\Status;
use ContextDev\Batch\BatchListResponse\Data\Timing;
use ContextDev\Batch\CrawlControls;
use ContextDev\Batch\Failure;
use ContextDev\Batch\Intake;
use ContextDev\Batch\PageErrorCount;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * An asynchronous scrape or crawl job.
 *
 * @phpstan-import-type CrawlControlsShape from \ContextDev\Batch\CrawlControls
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchListResponse\Data\Credits
 * @phpstan-import-type FailureShape from \ContextDev\Batch\Failure
 * @phpstan-import-type FormatsShape from \ContextDev\Batch\BatchListResponse\Data\Formats
 * @phpstan-import-type IntakeShape from \ContextDev\Batch\Intake
 * @phpstan-import-type PageErrorCountShape from \ContextDev\Batch\PageErrorCount
 * @phpstan-import-type ProgressShape from \ContextDev\Batch\BatchListResponse\Data\Progress
 * @phpstan-import-type ResultsShape from \ContextDev\Batch\BatchListResponse\Data\Results
 * @phpstan-import-type TimingShape from \ContextDev\Batch\BatchListResponse\Data\Timing
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   crawl: null|CrawlControls|CrawlControlsShape,
 *   credits: Credits|CreditsShape,
 *   failure: null|Failure|FailureShape,
 *   formats: Formats|FormatsShape,
 *   input: Intake|IntakeShape,
 *   mode: Mode|value-of<Mode>,
 *   pageErrors: list<PageErrorCount|PageErrorCountShape>,
 *   progress: Progress|ProgressShape,
 *   results: null|Results|ResultsShape,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   timing: Timing|TimingShape,
 *   policies?: list<string>|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique ID of the batch.
     */
    #[Required]
    public string $id;

    /**
     * Crawl settings as submitted.
     */
    #[Required]
    public ?CrawlControls $crawl;

    /**
     * Credits reserved, refunded, and charged for the batch.
     */
    #[Required]
    public Credits $credits;

    /**
     * Why the batch as a whole failed. Individual page failures are counted in `page_errors`.
     */
    #[Required]
    public ?Failure $failure;

    /**
     * Formats requested for each page, as submitted in `input.data.formats`.
     */
    #[Required]
    public Formats $formats;

    /**
     * Page counts from your submission.
     */
    #[Required]
    public Intake $input;

    /**
     * `scrape` for a URL list, `crawl` for a site crawl.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Page failures grouped by error code, most common first. For the batch itself failing, see `failure`.
     *
     * @var list<PageErrorCount> $pageErrors
     */
    #[Required('page_errors', list: PageErrorCount::class)]
    public array $pageErrors;

    /**
     * Page counts so far. Check `status` to know when the batch is done.
     */
    #[Required]
    public Progress $progress;

    /**
     * Links to download the results. `null` until the batch finishes; the files are deleted 180 days after that.
     */
    #[Required]
    public ?Results $results;

    /**
     * Current state. `pending` batches are being validated or are waiting for a slot under your plan's concurrent batch limit, `queued` batches are ready to start, and `running` batches are scraping. `completed`, `cancelled`, and `failed` are final.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Tags set when the batch was submitted.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * When the batch was created, started, and finished.
     */
    #[Required]
    public Timing $timing;

    /**
     * Access policy IDs applied to every page.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   crawl: ...,
     *   credits: ...,
     *   failure: ...,
     *   formats: ...,
     *   input: ...,
     *   mode: ...,
     *   pageErrors: ...,
     *   progress: ...,
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
     * (new Data)
     *   ->withID(...)
     *   ->withCrawl(...)
     *   ->withCredits(...)
     *   ->withFailure(...)
     *   ->withFormats(...)
     *   ->withInput(...)
     *   ->withMode(...)
     *   ->withPageErrors(...)
     *   ->withProgress(...)
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
     * @param Formats|FormatsShape $formats
     * @param Intake|IntakeShape $input
     * @param Mode|value-of<Mode> $mode
     * @param list<PageErrorCount|PageErrorCountShape> $pageErrors
     * @param Progress|ProgressShape $progress
     * @param Results|ResultsShape|null $results
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param Timing|TimingShape $timing
     * @param list<string>|null $policies
     */
    public static function with(
        string $id,
        CrawlControls|array|null $crawl,
        Credits|array $credits,
        Failure|array|null $failure,
        Formats|array $formats,
        Intake|array $input,
        Mode|string $mode,
        array $pageErrors,
        Progress|array $progress,
        Results|array|null $results,
        Status|string $status,
        array $tags,
        Timing|array $timing,
        ?array $policies = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['crawl'] = $crawl;
        $self['credits'] = $credits;
        $self['failure'] = $failure;
        $self['formats'] = $formats;
        $self['input'] = $input;
        $self['mode'] = $mode;
        $self['pageErrors'] = $pageErrors;
        $self['progress'] = $progress;
        $self['results'] = $results;
        $self['status'] = $status;
        $self['tags'] = $tags;
        $self['timing'] = $timing;

        null !== $policies && $self['policies'] = $policies;

        return $self;
    }

    /**
     * Unique ID of the batch.
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
     * Credits reserved, refunded, and charged for the batch.
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
     * Why the batch as a whole failed. Individual page failures are counted in `page_errors`.
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
     * Formats requested for each page, as submitted in `input.data.formats`.
     *
     * @param Formats|FormatsShape $formats
     */
    public function withFormats(Formats|array $formats): self
    {
        $self = clone $this;
        $self['formats'] = $formats;

        return $self;
    }

    /**
     * Page counts from your submission.
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
     * `scrape` for a URL list, `crawl` for a site crawl.
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
     * Page failures grouped by error code, most common first. For the batch itself failing, see `failure`.
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
     * Page counts so far. Check `status` to know when the batch is done.
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
     * Links to download the results. `null` until the batch finishes; the files are deleted 180 days after that.
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
     * Current state. `pending` batches are being validated or are waiting for a slot under your plan's concurrent batch limit, `queued` batches are ready to start, and `running` batches are scraping. `completed`, `cancelled`, and `failed` are final.
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
     * Tags set when the batch was submitted.
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
     * When the batch was created, started, and finished.
     *
     * @param Timing|TimingShape $timing
     */
    public function withTiming(Timing|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }

    /**
     * Access policy IDs applied to every page.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }
}
