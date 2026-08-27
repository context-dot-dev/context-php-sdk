<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchSubmitResponse\CacheMetadata;
use ContextDev\Batch\BatchSubmitResponse\Credits;
use ContextDev\Batch\BatchSubmitResponse\Format;
use ContextDev\Batch\BatchSubmitResponse\InvalidURL;
use ContextDev\Batch\BatchSubmitResponse\KeyMetadata;
use ContextDev\Batch\BatchSubmitResponse\Mode;
use ContextDev\Batch\BatchSubmitResponse\Status;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Batch\BatchSubmitResponse\CacheMetadata
 * @phpstan-import-type CrawlControlsShape from \ContextDev\Batch\CrawlControls
 * @phpstan-import-type CreditsShape from \ContextDev\Batch\BatchSubmitResponse\Credits
 * @phpstan-import-type IntakeShape from \ContextDev\Batch\Intake
 * @phpstan-import-type InvalidURLShape from \ContextDev\Batch\BatchSubmitResponse\InvalidURL
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchSubmitResponse\KeyMetadata
 *
 * @phpstan-type BatchSubmitResponseShape = array{
 *   id: string,
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   crawl: null|CrawlControls|CrawlControlsShape,
 *   createdAt: string,
 *   credits: Credits|CreditsShape,
 *   format: Format|value-of<Format>,
 *   input: Intake|IntakeShape,
 *   invalidURLs: list<InvalidURL|InvalidURLShape>,
 *   mode: Mode|value-of<Mode>,
 *   status: Status|value-of<Status>,
 *   tags: list<string>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   webhookSecret?: string|null,
 * }
 */
final class BatchSubmitResponse implements BaseModel
{
    /** @use SdkModel<BatchSubmitResponseShape> */
    use SdkModel;

    /**
     * Batch ID. Poll GET /batch/{batch_id} with it.
     */
    #[Required]
    public string $id;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * The crawl controls as submitted, so the limits requested can be compared against what the crawl reached.
     */
    #[Required]
    public ?CrawlControls $crawl;

    /**
     * When the batch was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * What accepting this batch cost.
     */
    #[Required]
    public Credits $credits;

    /**
     * What each page will be returned as.
     *
     * @var value-of<Format> $format
     */
    #[Required(enum: Format::class)]
    public string $format;

    /**
     * What submission took in, and what it charged for.
     */
    #[Required]
    public Intake $input;

    /**
     * Rejected URLs, up to 100. These are not charged.
     *
     * @var list<InvalidURL> $invalidURLs
     */
    #[Required('invalid_urls', list: InvalidURL::class)]
    public array $invalidURLs;

    /**
     * How pages will be selected.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Always `queued`. An accepted batch has not started yet.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Tags stored on the batch.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * API key usage for this request.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Signing secret for the completion webhook, returned only here and never again. Store it now; it is not repeated by GET /batch/{batch_id}.
     */
    #[Optional('webhook_secret')]
    public ?string $webhookSecret;

    /**
     * `new BatchSubmitResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchSubmitResponse::with(
     *   id: ...,
     *   cacheMetadata: ...,
     *   crawl: ...,
     *   createdAt: ...,
     *   credits: ...,
     *   format: ...,
     *   input: ...,
     *   invalidURLs: ...,
     *   mode: ...,
     *   status: ...,
     *   tags: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchSubmitResponse)
     *   ->withID(...)
     *   ->withCacheMetadata(...)
     *   ->withCrawl(...)
     *   ->withCreatedAt(...)
     *   ->withCredits(...)
     *   ->withFormat(...)
     *   ->withInput(...)
     *   ->withInvalidURLs(...)
     *   ->withMode(...)
     *   ->withStatus(...)
     *   ->withTags(...)
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
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     * @param CrawlControls|CrawlControlsShape|null $crawl
     * @param Credits|CreditsShape $credits
     * @param Format|value-of<Format> $format
     * @param Intake|IntakeShape $input
     * @param list<InvalidURL|InvalidURLShape> $invalidURLs
     * @param Mode|value-of<Mode> $mode
     * @param Status|value-of<Status> $status
     * @param list<string> $tags
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $id,
        CacheMetadata|array $cacheMetadata,
        CrawlControls|array|null $crawl,
        string $createdAt,
        Credits|array $credits,
        Format|string $format,
        Intake|array $input,
        array $invalidURLs,
        Mode|string $mode,
        Status|string $status,
        array $tags,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $webhookSecret = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cacheMetadata'] = $cacheMetadata;
        $self['crawl'] = $crawl;
        $self['createdAt'] = $createdAt;
        $self['credits'] = $credits;
        $self['format'] = $format;
        $self['input'] = $input;
        $self['invalidURLs'] = $invalidURLs;
        $self['mode'] = $mode;
        $self['status'] = $status;
        $self['tags'] = $tags;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $webhookSecret && $self['webhookSecret'] = $webhookSecret;

        return $self;
    }

    /**
     * Batch ID. Poll GET /batch/{batch_id} with it.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     *
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     */
    public function withCacheMetadata(CacheMetadata|array $cacheMetadata): self
    {
        $self = clone $this;
        $self['cacheMetadata'] = $cacheMetadata;

        return $self;
    }

    /**
     * The crawl controls as submitted, so the limits requested can be compared against what the crawl reached.
     *
     * @param CrawlControls|CrawlControlsShape|null $crawl
     */
    public function withCrawl(CrawlControls|array|null $crawl): self
    {
        $self = clone $this;
        $self['crawl'] = $crawl;

        return $self;
    }

    /**
     * When the batch was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * What accepting this batch cost.
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
     * What each page will be returned as.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * What submission took in, and what it charged for.
     *
     * @param Intake|IntakeShape $input
     */
    public function withInput(Intake|array $input): self
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
     * How pages will be selected.
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
     * Always `queued`. An accepted batch has not started yet.
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
     * Tags stored on the batch.
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
     * Signing secret for the completion webhook, returned only here and never again. Store it now; it is not repeated by GET /batch/{batch_id}.
     */
    public function withWebhookSecret(string $webhookSecret): self
    {
        $self = clone $this;
        $self['webhookSecret'] = $webhookSecret;

        return $self;
    }
}
