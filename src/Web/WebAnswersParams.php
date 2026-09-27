<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebAnswersParams\Mode;
use ContextDev\Web\WebAnswersParams\TimeoutOpts;
use ContextDev\Web\WebAnswersParams\Zdr;

/**
 * Research the web and return a sourced answer in your JSON shape. Choose `fast` for a short task or `ultra` for deeper research.
 *
 * @see ContextDev\Services\WebService::answers()
 *
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebAnswersParams\TimeoutOpts
 *
 * @phpstan-type WebAnswersParamsShape = array{
 *   task: string,
 *   jsonFormat?: array<string,mixed>|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebAnswersParams implements BaseModel
{
    /** @use SdkModel<WebAnswersParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Research task. Name a domain to have it read before searching.
     */
    #[Required]
    public string $task;

    /**
     * Example answer object, not JSON Schema. Up to 8 levels, 500 values, and 16000 characters; unknowns may be null.
     *
     * @var array<string,mixed>|null $jsonFormat
     */
    #[Optional('json_format', map: 'mixed')]
    public ?array $jsonFormat;

    /**
     * `fast` for short tasks; `ultra` for deeper research (default).
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebAnswersParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebAnswersParams::with(task: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebAnswersParams)->withTask(...)
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
     * @param array<string,mixed>|null $jsonFormat
     * @param Mode|value-of<Mode>|null $mode
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $task,
        ?array $jsonFormat = null,
        Mode|string|null $mode = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['task'] = $task;

        null !== $jsonFormat && $self['jsonFormat'] = $jsonFormat;
        null !== $mode && $self['mode'] = $mode;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Research task. Name a domain to have it read before searching.
     */
    public function withTask(string $task): self
    {
        $self = clone $this;
        $self['task'] = $task;

        return $self;
    }

    /**
     * Example answer object, not JSON Schema. Up to 8 levels, 500 values, and 16000 characters; unknowns may be null.
     *
     * @param array<string,mixed> $jsonFormat
     */
    public function withJsonFormat(array $jsonFormat): self
    {
        $self = clone $this;
        $self['jsonFormat'] = $jsonFormat;

        return $self;
    }

    /**
     * `fast` for short tasks; `ultra` for deeper research (default).
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
     * Labels for filtering usage in the dashboard.
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
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
