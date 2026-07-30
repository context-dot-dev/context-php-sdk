<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchGetResponse\Credits;
use ContextDev\Batch\BatchGetResponse\Error;
use ContextDev\Batch\BatchGetResponse\Error1;
use ContextDev\Batch\BatchGetResponse\Input;
use ContextDev\Batch\BatchGetResponse\InvalidURL;
use ContextDev\Batch\BatchGetResponse\KeyMetadata;
use ContextDev\Batch\BatchGetResponse\Mode;
use ContextDev\Batch\BatchGetResponse\Progress;
use ContextDev\Batch\BatchGetResponse\Results;
use ContextDev\Batch\BatchGetResponse\Status;
use ContextDev\Batch\BatchGetResponse\Timing;
use ContextDev\Batch\BatchGetResponse\Type;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchGetResponse\Credits
 * @phpstan-import-type ErrorShape from \ContextDev\Batch\BatchGetResponse\Error
 * @phpstan-import-type Error1Shape from \ContextDev\Batch\BatchGetResponse\Error1
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchGetResponse\Input
 * @phpstan-import-type InvalidURLShape from \ContextDev\Batch\BatchGetResponse\InvalidURL
 * @phpstan-import-type ProgressShape from \ContextDev\Batch\BatchGetResponse\Progress
 * @phpstan-import-type ResultsShape from \ContextDev\Batch\BatchGetResponse\Results
 * @phpstan-import-type TimingShape from \ContextDev\Batch\BatchGetResponse\Timing
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchGetResponse\KeyMetadata
 *
 * @phpstan-type BatchGetResponseShape = array{
 *   id: string,
 *   credits: Credits|CreditsShape,
 *   error: null|Error|ErrorShape,
 *   errors: list<Error1|Error1Shape>,
 *   input: Input|InputShape,
 *   invalidURLs: list<InvalidURL|InvalidURLShape>,
 *   mode: Mode|value-of<Mode>,
 *   progress: Progress|ProgressShape,
 *   results: null|Results|ResultsShape,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   timing: Timing|TimingShape,
 *   type: Type|value-of<Type>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   webhookSecret?: string|null,
 * }
 */
final class BatchGetResponse implements BaseModel
{
    /** @use SdkModel<BatchGetResponseShape> */
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
     * Rejected URLs, up to 100. These are not charged.
     *
     * @var list<InvalidURL> $invalidURLs
     */
    #[Required('invalid_urls', list: InvalidURL::class)]
    public array $invalidURLs;

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
     * API key usage for this request.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Webhook signing secret. Also returned by GET /batch/{batch_id}.
     */
    #[Optional('webhook_secret')]
    public ?string $webhookSecret;

    /**
     * `new BatchGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchGetResponse::with(
     *   id: ...,
     *   credits: ...,
     *   error: ...,
     *   errors: ...,
     *   input: ...,
     *   invalidURLs: ...,
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
     * (new BatchGetResponse)
     *   ->withID(...)
     *   ->withCredits(...)
     *   ->withError(...)
     *   ->withErrors(...)
     *   ->withInput(...)
     *   ->withInvalidURLs(...)
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
     * @param list<InvalidURL|InvalidURLShape> $invalidURLs
     * @param Mode|value-of<Mode> $mode
     * @param Progress|ProgressShape $progress
     * @param Results|ResultsShape|null $results
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param Timing|TimingShape $timing
     * @param Type|value-of<Type> $type
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $id,
        Credits|array $credits,
        Error|array|null $error,
        array $errors,
        Input|array $input,
        array $invalidURLs,
        Mode|string $mode,
        Progress|array $progress,
        Results|array|null $results,
        Status|string $status,
        array $tags,
        Timing|array $timing,
        Type|string $type,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $webhookSecret = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['credits'] = $credits;
        $self['error'] = $error;
        $self['errors'] = $errors;
        $self['input'] = $input;
        $self['invalidURLs'] = $invalidURLs;
        $self['mode'] = $mode;
        $self['progress'] = $progress;
        $self['results'] = $results;
        $self['status'] = $status;
        $self['tags'] = $tags;
        $self['timing'] = $timing;
        $self['type'] = $type;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $webhookSecret && $self['webhookSecret'] = $webhookSecret;

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
     * Rejected URLs, up to 100. These are not charged.
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
     * Webhook signing secret. Also returned by GET /batch/{batch_id}.
     */
    public function withWebhookSecret(string $webhookSecret): self
    {
        $self = clone $this;
        $self['webhookSecret'] = $webhookSecret;

        return $self;
    }
}
