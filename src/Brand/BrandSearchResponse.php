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
 *   requestID: string,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class BrandSearchResponse implements BaseModel
{
    /** @use SdkModel<BrandSearchResponseShape> */
    use SdkModel;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Up to 10 matching brands, name matches first, then domain matches, most popular first within each group. Empty when nothing matches.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new BrandSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSearchResponse::with(requestID: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSearchResponse)->withRequestID(...)->withResults(...)
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
        string $requestID,
        array $results,
        KeyMetadata|array|null $keyMetadata = null
    ): self {
        $self = new self;

        $self['requestID'] = $requestID;
        $self['results'] = $results;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Up to 10 matching brands, name matches first, then domain matches, most popular first within each group. Empty when nothing matches.
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
     * Credit usage, included whenever a valid API key is provided.
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
