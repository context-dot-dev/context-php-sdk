<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse;

use ContextDev\Batch\BatchListResponse\Data\Credits;
use ContextDev\Batch\BatchListResponse\Data\Format;
use ContextDev\Batch\BatchListResponse\Data\Mode;
use ContextDev\Batch\BatchListResponse\Data\Progress;
use ContextDev\Batch\BatchListResponse\Data\Results;
use ContextDev\Batch\BatchListResponse\Data\Status;
use ContextDev\Batch\BatchListResponse\Data\Timing;
use ContextDev\Batch\CrawlControls;
use ContextDev\Batch\Failure;
use ContextDev\Batch\Intake;
use ContextDev\Batch\PageErrorCount;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * An asynchronous web scraping job.
 *
 * @phpstan-import-type CrawlControlsShape from \ContextDev\Batch\CrawlControls
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchListResponse\Data\Credits
 * @phpstan-import-type FailureShape from \ContextDev\Batch\Failure
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
 *   format: Format|value-of<Format>,
 *   input: Intake|IntakeShape,
 *   mode: Mode|value-of<Mode>,
 *   pageErrors: list<PageErrorCount|PageErrorCountShape>,
 *   progress: Progress|ProgressShape,
 *   results: null|Results|ResultsShape,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   timing: Timing|TimingShape,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
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
     * Result download links; null until the batch finishes. Files are deleted 180 days after the batch finishes.
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
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   crawl: ...,
     *   credits: ...,
     *   failure: ...,
     *   format: ...,
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
     *   ->withFormat(...)
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
     * @param Format|value-of<Format> $format
     * @param Intake|IntakeShape $input
     * @param Mode|value-of<Mode> $mode
     * @param list<PageErrorCount|PageErrorCountShape> $pageErrors
     * @param Progress|ProgressShape $progress
     * @param Results|ResultsShape|null $results
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param Timing|TimingShape $timing
     */
    public static function with(
        string $id,
        CrawlControls|array|null $crawl,
        Credits|array $credits,
        Failure|array|null $failure,
        Format|string $format,
        Intake|array $input,
        Mode|string $mode,
        array $pageErrors,
        Progress|array $progress,
        Results|array|null $results,
        Status|string $status,
        array $tags,
        Timing|array $timing,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['crawl'] = $crawl;
        $self['credits'] = $credits;
        $self['failure'] = $failure;
        $self['format'] = $format;
        $self['input'] = $input;
        $self['mode'] = $mode;
        $self['pageErrors'] = $pageErrors;
        $self['progress'] = $progress;
        $self['results'] = $results;
        $self['status'] = $status;
        $self['tags'] = $tags;
        $self['timing'] = $timing;

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
     * Result download links; null until the batch finishes. Files are deleted 180 days after the batch finishes.
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
}
