<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchResponse\KeyMetadata;
use ContextDev\Web\WebSearchResponse\Result;

/**
 * @phpstan-import-type ResultShape from \ContextDev\Web\WebSearchResponse\Result
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebSearchResponse\KeyMetadata
 *
 * @phpstan-type WebSearchResponseShape = array{
 *   query: string,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebSearchResponse implements BaseModel
{
    /** @use SdkModel<WebSearchResponseShape> */
    use SdkModel;

    /**
     * Echo of the original query (useful when fanout was enabled).
     */
    #[Required]
    public string $query;

    /** @var list<Result> $results */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebSearchResponse::with(query: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebSearchResponse)->withQuery(...)->withResults(...)
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
     * @param list<Result|ResultShape> $results
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $query,
        array $results,
        KeyMetadata|array|null $keyMetadata = null
    ): self {
        $self = new self;

        $self['query'] = $query;
        $self['results'] = $results;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Echo of the original query (useful when fanout was enabled).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

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
