<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorRotateWebhookSecretResponse\Baseline\MonitorsSearchBaseline;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResultShape = array{
 *   description: string,
 *   publishedAt: \DateTimeInterface|null,
 *   title: string,
 *   url: string,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Result snippet.
     */
    #[Required]
    public string $description;

    /**
     * When the result was published. `null` when unknown.
     */
    #[Required('published_at')]
    public ?\DateTimeInterface $publishedAt;

    /**
     * Title of the result.
     */
    #[Required]
    public string $title;

    /**
     * URL of the result.
     */
    #[Required]
    public string $url;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(description: ..., publishedAt: ..., title: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withDescription(...)
     *   ->withPublishedAt(...)
     *   ->withTitle(...)
     *   ->withURL(...)
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
     */
    public static function with(
        string $description,
        ?\DateTimeInterface $publishedAt,
        string $title,
        string $url,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['publishedAt'] = $publishedAt;
        $self['title'] = $title;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Result snippet.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * When the result was published. `null` when unknown.
     */
    public function withPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * Title of the result.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * URL of the result.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
