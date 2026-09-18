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
 * Researches the live web and returns a sourced answer in your requested JSON shape. Select fast for a smaller research budget at 10 credits or ultra for deeper reasoning at 100 credits. Defaults to ultra. Fast research is limited to 30 seconds and ultra to 50 seconds; timeoutOpts.milliseconds can shorten either deadline.
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
     * What to research and answer, in plain language. Naming a domain in the task (for example "pricing on context.dev") makes the agent read that site before it searches.
     */
    #[Required]
    public string $task;

    /**
     * An example object with placeholder values (for example {"pricing_page_url": "", "plans": [{"name": "", "price": 0}]}). Object keys and value types are preserved; unknown values may be null. Empty arrays accept any JSON items. Defaults to {"result": ""}. Maximum 8 levels, 500 values, and 16000 characters.
     *
     * @var array<string,mixed>|null $jsonFormat
     */
    #[Optional('json_format', map: 'mixed')]
    public ?array $jsonFormat;

    /**
     * Research level: fast uses a smaller model and research budget for 10 credits; ultra uses deeper reasoning and research for 100 credits. Defaults to ultra. Only successful requests consume credits.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
     * What to research and answer, in plain language. Naming a domain in the task (for example "pricing on context.dev") makes the agent read that site before it searches.
     */
    public function withTask(string $task): self
    {
        $self = clone $this;
        $self['task'] = $task;

        return $self;
    }

    /**
     * An example object with placeholder values (for example {"pricing_page_url": "", "plans": [{"name": "", "price": 0}]}). Object keys and value types are preserved; unknown values may be null. Empty arrays accept any JSON items. Defaults to {"result": ""}. Maximum 8 levels, 500 values, and 16000 characters.
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
     * Research level: fast uses a smaller model and research budget for 10 credits; ultra uses deeper reasoning and research for 100 credits. Defaults to ultra. Only successful requests consume credits.
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
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
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
     * Optional request deadline and behavior on timeout. For GET requests, use timeoutOpts[milliseconds]=30000&timeoutOpts[behavior]=fail or a JSON-encoded timeoutOpts object.
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
     * Set to enabled to bypass shared caches and omit request and response content from retained usage logs. Asset uploads are skipped, so hosted image URLs are omitted. Requires zero data retention to be enabled for your organization (contact support@context.dev), otherwise the request fails with ZDR_NOT_ENABLED. Successful ZDR responses include X-Context-ZDR: true.
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
