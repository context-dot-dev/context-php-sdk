<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebCrawlMdResponse\KeyMetadata;
use ContextDev\Web\WebWebCrawlMdResponse\Metadata;
use ContextDev\Web\WebWebCrawlMdResponse\Result;

/**
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebWebCrawlMdResponse\Metadata
 * @phpstan-import-type ResultShape from \ContextDev\Web\WebWebCrawlMdResponse\Result
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebCrawlMdResponse\KeyMetadata
 *
 * @phpstan-type WebWebCrawlMdResponseShape = array{
 *   metadata: Metadata|MetadataShape,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebCrawlMdResponse implements BaseModel
{
    /** @use SdkModel<WebWebCrawlMdResponseShape> */
    use SdkModel;

    #[Required]
    public Metadata $metadata;

    /** @var list<Result> $results */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebCrawlMdResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebCrawlMdResponse::with(metadata: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebCrawlMdResponse)->withMetadata(...)->withResults(...)
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
     * @param list<Result|ResultShape> $results
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        Metadata|array $metadata,
        array $results,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['metadata'] = $metadata;
        $self['results'] = $results;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }
}
