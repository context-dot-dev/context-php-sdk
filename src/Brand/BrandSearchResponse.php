<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandSearchResponse\KeyMetadata;
use ContextDev\Brand\BrandSearchResponse\Result;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultShape from \ContextDev\Brand\BrandSearchResponse\Result
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Brand\BrandSearchResponse\KeyMetadata
 *
 * @phpstan-type BrandSearchResponseShape = array{
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class BrandSearchResponse implements BaseModel
{
    /** @use SdkModel<BrandSearchResponseShape> */
    use SdkModel;

    /**
     * Up to 10 matching brands, most popular first. Empty when nothing matches.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new BrandSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSearchResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSearchResponse)->withResults(...)
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
        array $results,
        KeyMetadata|array|null $keyMetadata = null
    ): self {
        $self = new self;

        $self['results'] = $results;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Up to 10 matching brands, most popular first. Empty when nothing matches.
     *
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
