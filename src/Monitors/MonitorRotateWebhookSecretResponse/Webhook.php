<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorRotateWebhookSecretResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorRotateWebhookSecretResponse\Webhook\Event;
use ContextDev\Webhooks\RetryConfig;

/**
 * Webhook destination and delivery settings. Null means no webhook is configured.
 *
 * @phpstan-import-type RetryConfigShape from \ContextDev\Webhooks\RetryConfig
 *
 * @phpstan-type WebhookShape = array{
 *   url: string,
 *   events?: list<Event|value-of<Event>>|null,
 *   retry?: null|RetryConfig|RetryConfigShape,
 *   secret?: string|null,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<WebhookShape> */
    use SdkModel;

    /**
     * Public HTTP(S) URL that receives events. Slack and GovSlack URLs get formatted messages.
     */
    #[Required]
    public string $url;

    /**
     * Events to deliver. Defaults to `change.detected`; `run.completed` also includes unchanged runs.
     *
     * @var list<value-of<Event>>|null $events
     */
    #[Optional(list: Event::class)]
    public ?array $events;

    /**
     * Webhook retry settings. Use {} for the default schedule.
     */
    #[Optional]
    public ?RetryConfig $retry;

    /**
     * API-generated signing secret. Visible only with full access or `monitors:write` permission.
     */
    #[Optional]
    public ?string $secret;

    /**
     * `new Webhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Webhook::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Webhook)->withURL(...)
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
     * @param list<Event|value-of<Event>>|null $events
     * @param RetryConfig|RetryConfigShape|null $retry
     */
    public static function with(
        string $url,
        ?array $events = null,
        RetryConfig|array|null $retry = null,
        ?string $secret = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $events && $self['events'] = $events;
        null !== $retry && $self['retry'] = $retry;
        null !== $secret && $self['secret'] = $secret;

        return $self;
    }

    /**
     * Public HTTP(S) URL that receives events. Slack and GovSlack URLs get formatted messages.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Events to deliver. Defaults to `change.detected`; `run.completed` also includes unchanged runs.
     *
     * @param list<Event|value-of<Event>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * Webhook retry settings. Use {} for the default schedule.
     *
     * @param RetryConfig|RetryConfigShape $retry
     */
    public function withRetry(RetryConfig|array $retry): self
    {
        $self = clone $this;
        $self['retry'] = $retry;

        return $self;
    }

    /**
     * API-generated signing secret. Visible only with full access or `monitors:write` permission.
     */
    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }
}
