<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse;

use ContextDev\Batch\BatchListResponse\Data\Credits;
use ContextDev\Batch\BatchListResponse\Data\Error;
use ContextDev\Batch\BatchListResponse\Data\Error1;
use ContextDev\Batch\BatchListResponse\Data\Input;
use ContextDev\Batch\BatchListResponse\Data\Mode;
use ContextDev\Batch\BatchListResponse\Data\Progress;
use ContextDev\Batch\BatchListResponse\Data\Results;
use ContextDev\Batch\BatchListResponse\Data\Status;
use ContextDev\Batch\BatchListResponse\Data\Timing;
use ContextDev\Batch\BatchListResponse\Data\Type;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * An asynchronous web scraping job.
 *
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchListResponse\Data\Credits
 * @phpstan-import-type ErrorShape from \ContextDev\Batch\BatchListResponse\Data\Error
 * @phpstan-import-type Error1Shape from \ContextDev\Batch\BatchListResponse\Data\Error1
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchListResponse\Data\Input
 * @phpstan-import-type ProgressShape from \ContextDev\Batch\BatchListResponse\Data\Progress
 * @phpstan-import-type ResultsShape from \ContextDev\Batch\BatchListResponse\Data\Results
 * @phpstan-import-type TimingShape from \ContextDev\Batch\BatchListResponse\Data\Timing
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   credits: Credits|CreditsShape,
 *   error: null|Error|ErrorShape,
 *   errors: list<Error1|Error1Shape>,
 *   input: Input|InputShape,
 *   mode: Mode|value-of<Mode>,
 *   progress: Progress|ProgressShape,
 *   results: null|Results|ResultsShape,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   timing: Timing|TimingShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Batch ID used to retrieve or cancel the job.
     */
    #[Required]
    public string $id;

    /**
     * Reserved and used credits.
     */
    #[Required]
    public Credits $credits;

    /**
     * Batch-level error. Null unless `status` is `failed`.
     */
    #[Required]
    public ?Error $error;

    /**
     * Page failures grouped by error code.
     *
     * @var list<Error1> $errors
     */
    #[Required(list: Error1::class)]
    public array $errors;

    /**
     * Submission counts.
     */
    #[Required]
    public Input $input;

    /**
     * How pages are selected.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Current processing counts. Use `status` to check completion.
     */
    #[Required]
    public Progress $progress;

    /**
     * Download links available when the batch finishes. GET /batch/{batch_id}/results serves the same records as paginated JSON.
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
     * Output format.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   credits: ...,
     *   error: ...,
     *   errors: ...,
     *   input: ...,
     *   mode: ...,
     *   progress: ...,
     *   results: ...,
     *   status: ...,
     *   tags: ...,
     *   timing: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withID(...)
     *   ->withCredits(...)
     *   ->withError(...)
     *   ->withErrors(...)
     *   ->withInput(...)
     *   ->withMode(...)
     *   ->withProgress(...)
     *   ->withResults(...)
     *   ->withStatus(...)
     *   ->withTags(...)
     *   ->withTiming(...)
     *   ->withType(...)
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
     * @param Credits|CreditsShape $credits
     * @param Error|ErrorShape|null $error
     * @param list<Error1|Error1Shape> $errors
     * @param Input|InputShape $input
     * @param Mode|value-of<Mode> $mode
     * @param Progress|ProgressShape $progress
     * @param Results|ResultsShape|null $results
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param Timing|TimingShape $timing
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Credits|array $credits,
        Error|array|null $error,
        array $errors,
        Input|array $input,
        Mode|string $mode,
        Progress|array $progress,
        Results|array|null $results,
        Status|string $status,
        array $tags,
        Timing|array $timing,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['credits'] = $credits;
        $self['error'] = $error;
        $self['errors'] = $errors;
        $self['input'] = $input;
        $self['mode'] = $mode;
        $self['progress'] = $progress;
        $self['results'] = $results;
        $self['status'] = $status;
        $self['tags'] = $tags;
        $self['timing'] = $timing;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Batch ID used to retrieve or cancel the job.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Reserved and used credits.
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
     * Batch-level error. Null unless `status` is `failed`.
     *
     * @param Error|ErrorShape|null $error
     */
    public function withError(Error|array|null $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Page failures grouped by error code.
     *
     * @param list<Error1|Error1Shape> $errors
     */
    public function withErrors(array $errors): self
    {
        $self = clone $this;
        $self['errors'] = $errors;

        return $self;
    }

    /**
     * Submission counts.
     *
     * @param Input|InputShape $input
     */
    public function withInput(Input|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * How pages are selected.
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
     * Current processing counts. Use `status` to check completion.
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
     * Download links available when the batch finishes. GET /batch/{batch_id}/results serves the same records as paginated JSON.
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
     * Output format.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
