<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchSubmitParams\Input;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape 25K URLs or crawl large websites asynchronously.
 *
 * @see ContextDev\Services\BatchService::submit()
 *
 * @phpstan-import-type InputVariants from \ContextDev\Batch\BatchSubmitParams\Input
 * @phpstan-import-type InputShape from \ContextDev\Batch\BatchSubmitParams\Input
 *
 * @phpstan-type BatchSubmitParamsShape = array{
 *   input: InputShape,
 *   tags?: list<string>|null,
 *   webhookURL?: string|null,
 *   idempotencyKey?: string|null,
 * }
 */
final class BatchSubmitParams implements BaseModel
{
    /** @use SdkModel<BatchSubmitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Choose a URL list or a site crawl.
     *
     * @var InputVariants $input
     */
    #[Required(union: Input::class)]
    public Scrape|Crawl $input;

    /**
     * Tags stored on the batch. Filter the batch list by them later.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * URL notified when the batch finishes.
     */
    #[Optional('webhookUrl')]
    public ?string $webhookURL;

    /**
     * Any string unique to this submission. Retries with the same key return the original batch.
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
     * @param list<string>|null $tags
     */
    public static function with(
        Scrape|array|Crawl $input,
        ?array $tags = null,
        ?string $webhookURL = null,
        ?string $idempotencyKey = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $tags && $self['tags'] = $tags;
        null !== $webhookURL && $self['webhookURL'] = $webhookURL;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Choose a URL list or a site crawl.
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
     * Tags stored on the batch. Filter the batch list by them later.
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
     * URL notified when the batch finishes.
     */
    public function withWebhookURL(string $webhookURL): self
    {
        $self = clone $this;
        $self['webhookURL'] = $webhookURL;

        return $self;
    }

    /**
     * Any string unique to this submission. Retries with the same key return the original batch.
     */
    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }
}
