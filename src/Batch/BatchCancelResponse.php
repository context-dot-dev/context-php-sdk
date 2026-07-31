<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchCancelResponse\Credits;
use ContextDev\Batch\BatchCancelResponse\Format;
use ContextDev\Batch\BatchCancelResponse\KeyMetadata;
use ContextDev\Batch\BatchCancelResponse\Mode;
use ContextDev\Batch\BatchCancelResponse\Progress;
use ContextDev\Batch\BatchCancelResponse\Status;
use ContextDev\Batch\BatchCancelResponse\Timing;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CrawlControlsShape from \ContextDev\Batch\CrawlControls
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchCancelResponse\Credits
 * @phpstan-import-type IntakeShape from \ContextDev\Batch\Intake
 * @phpstan-import-type PageErrorCountShape from \ContextDev\Batch\PageErrorCount
 * @phpstan-import-type ProgressShape from \ContextDev\Batch\BatchCancelResponse\Progress
 * @phpstan-import-type TimingShape from \ContextDev\Batch\BatchCancelResponse\Timing
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchCancelResponse\KeyMetadata
 *
 * @phpstan-type BatchCancelResponseShape = array{
 *   id: string,
 *   crawl: null|CrawlControls|CrawlControlsShape,
 *   credits: Credits|CreditsShape,
 *   format: Format|value-of<Format>,
 *   input: Intake|IntakeShape,
 *   mode: Mode|value-of<Mode>,
 *   pageErrors: list<PageErrorCount|PageErrorCountShape>,
 *   progress: Progress|ProgressShape,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   timing: Timing|TimingShape,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class BatchCancelResponse implements BaseModel
{
    /** @use SdkModel<BatchCancelResponseShape> */
    use SdkModel;

    /**
     * Batch ID.
     */
    #[Required]
    public string $id;

    /**
     * The crawl controls as submitted, so the limits requested can be compared against what the crawl reached.
     */
    #[Required]
    public ?CrawlControls $crawl;

    /**
     * What this batch cost so far.
     */
    #[Required]
    public Credits $credits;

    /**
     * What each page is returned as.
     *
     * @var value-of<Format> $format
     */
    #[Required(enum: Format::class)]
    public string $format;

    /**
     * What submission took in, and what it charged for.
     */
    #[Required]
    public Intake $input;

    /**
     * How pages were selected.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Page failures so far, grouped by error code and sorted by count.
     *
     * @var list<PageErrorCount> $pageErrors
     */
    #[Required('page_errors', list: PageErrorCount::class)]
    public array $pageErrors;

    /**
     * How far the batch got before cancellation.
     */
    #[Required]
    public Progress $progress;

    /**
     * Always `cancelling`. Work already in flight finishes; the batch reaches `cancelled` shortly after.
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

    /**
     * There is no finish time yet — the batch is still winding down.
     */
    #[Required]
    public Timing $timing;

    /**
     * API key usage for this request.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new BatchCancelResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchCancelResponse::with(
     *   id: ...,
     *   crawl: ...,
     *   credits: ...,
     *   format: ...,
     *   input: ...,
     *   mode: ...,
     *   pageErrors: ...,
     *   progress: ...,
     *   status: ...,
     *   tags: ...,
     *   timing: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchCancelResponse)
     *   ->withID(...)
     *   ->withCrawl(...)
     *   ->withCredits(...)
     *   ->withFormat(...)
     *   ->withInput(...)
     *   ->withMode(...)
     *   ->withPageErrors(...)
     *   ->withProgress(...)
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
     * @param Format|value-of<Format> $format
     * @param Intake|IntakeShape $input
     * @param Mode|value-of<Mode> $mode
     * @param list<PageErrorCount|PageErrorCountShape> $pageErrors
     * @param Progress|ProgressShape $progress
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param Timing|TimingShape $timing
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $id,
        CrawlControls|array|null $crawl,
        Credits|array $credits,
        Format|string $format,
        Intake|array $input,
        Mode|string $mode,
        array $pageErrors,
        Progress|array $progress,
        Status|string $status,
        array $tags,
        Timing|array $timing,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['crawl'] = $crawl;
        $self['credits'] = $credits;
        $self['format'] = $format;
        $self['input'] = $input;
        $self['mode'] = $mode;
        $self['pageErrors'] = $pageErrors;
        $self['progress'] = $progress;
        $self['status'] = $status;
        $self['tags'] = $tags;
        $self['timing'] = $timing;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
     * The crawl controls as submitted, so the limits requested can be compared against what the crawl reached.
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
     * What this batch cost so far.
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
     * What each page is returned as.
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
     * What submission took in, and what it charged for.
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
     * How pages were selected.
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
     * Page failures so far, grouped by error code and sorted by count.
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
     * How far the batch got before cancellation.
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
     * Always `cancelling`. Work already in flight finishes; the batch reaches `cancelled` shortly after.
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
     * There is no finish time yet — the batch is still winding down.
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
}
