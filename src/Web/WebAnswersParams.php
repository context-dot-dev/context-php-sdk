<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebAnswersParams\Controls;
use ContextDev\Web\WebAnswersParams\Mode;
use ContextDev\Web\WebAnswersParams\TimeoutOpts;
use ContextDev\Web\WebAnswersParams\Zdr;

/**
 * Research a task across the live web and Context.dev's company and people data, and get the answer in the JSON shape you provide, with the URLs it used. `fast` (10 credits) suits short lookups; `ultra` (100 credits, the default) reads more sources for deeper research.
 *
 * @see ContextDev\Services\WebService::answers()
 *
 * @phpstan-import-type ControlsShape from \ContextDev\Web\WebAnswersParams\Controls
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebAnswersParams\TimeoutOpts
 *
 * @phpstan-type WebAnswersParamsShape = array{
 *   task: string,
 *   controls?: null|Controls|ControlsShape,
 *   jsonFormat?: array<string,mixed>|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   policies?: list<string>|null,
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
     * What to research, in plain language, up to 2000 characters. Include domains or URLs to focus the research.
     */
    #[Required]
    public string $task;

    /**
     * Limit which sites the research can search, read, and cite.
     */
    #[Optional]
    public ?Controls $controls;

    /**
     * Example of the answer object to return, not a JSON Schema. Up to 8 levels deep, 500 values, and 16,000 characters. Values that cannot be found come back as `null`. Defaults to `{ "result": "" }`.
     *
     * @var array<string,mixed>|null $jsonFormat
     */
    #[Optional('json_format', map: 'mixed')]
    public ?array $jsonFormat;

    /**
     * `fast` prioritizes speed and adds extra verification for people and companies; `ultra` searches and reads more sources for deeper research. Defaults to `ultra`.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * @param Controls|ControlsShape|null $controls
     * @param array<string,mixed>|null $jsonFormat
     * @param Mode|value-of<Mode>|null $mode
     * @param list<string>|null $policies
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $task,
        Controls|array|null $controls = null,
        ?array $jsonFormat = null,
        Mode|string|null $mode = null,
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['task'] = $task;

        null !== $controls && $self['controls'] = $controls;
        null !== $jsonFormat && $self['jsonFormat'] = $jsonFormat;
        null !== $mode && $self['mode'] = $mode;
        null !== $policies && $self['policies'] = $policies;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * What to research, in plain language, up to 2000 characters. Include domains or URLs to focus the research.
     */
    public function withTask(string $task): self
    {
        $self = clone $this;
        $self['task'] = $task;

        return $self;
    }

    /**
     * Limit which sites the research can search, read, and cite.
     *
     * @param Controls|ControlsShape $controls
     */
    public function withControls(Controls|array $controls): self
    {
        $self = clone $this;
        $self['controls'] = $controls;

        return $self;
    }

    /**
     * Example of the answer object to return, not a JSON Schema. Up to 8 levels deep, 500 values, and 16,000 characters. Values that cannot be found come back as `null`. Defaults to `{ "result": "" }`.
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
     * `fast` prioritizes speed and adds extra verification for people and companies; `ultra` searches and reads more sources for deeper research. Defaults to `ultra`.
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
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
