<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\RetryConfig;

/**
 * Completion webhook settings. Cannot be combined with webhookUrl. Omitting retry preserves legacy delivery; retry: {} opts into durable retries.
 *
 * @phpstan-import-type RetryConfigShape from \ContextDev\Webhooks\RetryConfig
 *
 * @phpstan-type WebhookShape = array{
 *   url: string, retry?: null|RetryConfig|RetryConfigShape
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<WebhookShape> */
    use SdkModel;

    #[Required]
    public string $url;

    /**
     * Webhook retry settings. Use {} for the default schedule.
     */
    #[Optional]
    public ?RetryConfig $retry;

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
     * @param RetryConfig|RetryConfigShape|null $retry
     */
    public static function with(
        string $url,
        RetryConfig|array|null $retry = null
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $retry && $self['retry'] = $retry;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

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
}
