<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchSubmitParams\Input;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape;
use ContextDev\Batch\BatchSubmitParams\Webhook;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape up to 100,000 URLs, or crawl a site, asynchronously with every Scrape Anything format and option from `POST /web/scrape`. Poll `GET /batch/{batch_id}` or pass `webhook` to be notified when the batch finishes. URLs and credits are checked after the batch is accepted, so a batch that fails those checks ends as `failed` with a `failure` code instead of returning an error.
 *
 * @see ContextDev\Services\BatchService::submit()
 *
 * @phpstan-import-type InputVariants from \ContextDev\Batch\BatchSubmitParams\Input
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchSubmitParams\Input
 * @phpstan-import-type WebhookShape from \ContextDev\Batch\BatchSubmitParams\Webhook
 *
 * @phpstan-type BatchSubmitParamsShape = array{
 *   input: InputShape,
 *   policies?: list<string>|null,
 *   tags?: list<string>|null,
 *   webhook?: null|Webhook|WebhookShape,
 *   idempotencyKey?: string|null,
 * }
 */
final class BatchSubmitParams implements BaseModel
{
    /** @use SdkModel<BatchSubmitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * What to scrape: a list of URLs (`scrape`) or a site crawl (`crawl`).
     *
     * @var InputVariants $input
     */
    #[Required(union: Input::class)]
    public Scrape|Crawl $input;

    /**
     * Access policy IDs to apply to every page; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Tags to store on the batch. Filter `GET /batch/list` by them later.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Webhook to notify when the batch finishes. Omit `retry` for a single attempt, or pass `retry: {}` for the default retry schedule.
     */
    #[Optional]
    public ?Webhook $webhook;

    /**
     * Unique key for this submission. Retrying with the same key and body returns the original batch instead of creating another; a different body returns `409`.
     */
    #[Optional]
    public ?string $idempotencyKey;

    /**
     * `new BatchSubmitParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchSubmitParams::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchSubmitParams)->withInput(...)
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
     * @param InputShape $input
     * @param list<string>|null $policies
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        Scrape|array|Crawl $input,
        ?array $policies = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        ?string $idempotencyKey = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $policies && $self['policies'] = $policies;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhook && $self['webhook'] = $webhook;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * What to scrape: a list of URLs (`scrape`) or a site crawl (`crawl`).
     *
     * @param InputShape $input
     */
    public function withInput(Scrape|array|Crawl $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Access policy IDs to apply to every page; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
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
     * Tags to store on the batch. Filter `GET /batch/list` by them later.
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
     * Webhook to notify when the batch finishes. Omit `retry` for a single attempt, or pass `retry: {}` for the default retry schedule.
     *
     * @param Webhook|WebhookShape $webhook
     */
    public function withWebhook(Webhook|array $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * Unique key for this submission. Retrying with the same key and body returns the original batch instead of creating another; a different body returns `409`.
     */
    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }
}
