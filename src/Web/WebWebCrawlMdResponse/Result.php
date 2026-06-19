<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebCrawlMdResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata;

/**
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata
 *
 * @phpstan-type ResultShape = array{
 *   markdown: string,
 *   metadata: \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata|MetadataShape,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Extracted page content as Markdown (empty string on failure).
     */
    #[Required]
    public string $markdown;

    #[Required]
    public Metadata $metadata;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(markdown: ..., metadata: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withMarkdown(...)->withMetadata(...)
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
     * @param Metadata|MetadataShape $metadata
     */
    public static function with(
        string $markdown,
        Metadata|array $metadata,
    ): self {
        $self = new self;

        $self['markdown'] = $markdown;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Extracted page content as Markdown (empty string on failure).
     */
    public function withMarkdown(string $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(
        Metadata|array $metadata
    ): self {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
