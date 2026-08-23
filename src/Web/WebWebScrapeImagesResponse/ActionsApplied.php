<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesResponse\ActionsApplied\Status;

/**
 * @phpstan-type ActionsAppliedShape = array{
 *   instruction: string,
 *   status: Status|value-of<Status>,
 *   completionEvidence?: string|null,
 *   durationMs?: float|null,
 *   error?: string|null,
 *   method?: string|null,
 *   targetDescription?: string|null,
 * }
 */
final class ActionsApplied implements BaseModel
{
    /** @use SdkModel<ActionsAppliedShape> */
    use SdkModel;

    #[Required]
    public string $instruction;

    /**
     * Applied means the requested page state was visibly verified. Failed means it was not verified. Skipped means it was not attempted.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Visible page evidence used to verify an applied action.
     */
    #[Optional]
    public ?string $completionEvidence;

    #[Optional]
    public ?float $durationMs;

    #[Optional]
    public ?string $error;

    #[Optional]
    public ?string $method;

    #[Optional]
    public ?string $targetDescription;

    /**
     * `new ActionsApplied()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ActionsApplied::with(instruction: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ActionsApplied)->withInstruction(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $instruction,
        Status|string $status,
        ?string $completionEvidence = null,
        ?float $durationMs = null,
        ?string $error = null,
        ?string $method = null,
        ?string $targetDescription = null,
    ): self {
        $self = new self;

        $self['instruction'] = $instruction;
        $self['status'] = $status;

        null !== $completionEvidence && $self['completionEvidence'] = $completionEvidence;
        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $error && $self['error'] = $error;
        null !== $method && $self['method'] = $method;
        null !== $targetDescription && $self['targetDescription'] = $targetDescription;

        return $self;
    }

    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    /**
     * Applied means the requested page state was visibly verified. Failed means it was not verified. Skipped means it was not attempted.
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
     * Visible page evidence used to verify an applied action.
     */
    public function withCompletionEvidence(string $completionEvidence): self
    {
        $self = clone $this;
        $self['completionEvidence'] = $completionEvidence;

        return $self;
    }

    public function withDurationMs(float $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    public function withTargetDescription(string $targetDescription): self
    {
        $self = clone $this;
        $self['targetDescription'] = $targetDescription;

        return $self;
    }
}
