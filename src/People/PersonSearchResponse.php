<?php

declare(strict_types=1);

namespace ContextDev\People;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonSearchResponse\KeyMetadata;
use ContextDev\People\PersonSearchResponse\Result;

/**
 * @phpstan-import-type ResultShape from \ContextDev\People\PersonSearchResponse\Result
 * @phpstan-import-type KeyMetadataShape from \ContextDev\People\PersonSearchResponse\KeyMetadata
 *
 * @phpstan-type PersonSearchResponseShape = array{
 *   requestID: string,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   nextCursor?: string|null,
 * }
 */
final class PersonSearchResponse implements BaseModel
{
    /** @use SdkModel<PersonSearchResponseShape> */
    use SdkModel;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Up to 10 matching people, most relevant first.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Pass as cursor to fetch the next page; null when there are no more results.
     */
    #[Optional('next_cursor', nullable: true)]
    public ?string $nextCursor;

    /**
     * `new PersonSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PersonSearchResponse::with(requestID: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PersonSearchResponse)->withRequestID(...)->withResults(...)
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
        KeyMetadata|array|null $keyMetadata = null,
        ?string $nextCursor = null,
    ): self {
        $self = new self;

        $self['requestID'] = $requestID;
        $self['results'] = $results;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $nextCursor && $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Up to 10 matching people, most relevant first.
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
     * Credits this request used and your remaining balance.
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
     * Pass as cursor to fetch the next page; null when there are no more results.
     */
    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }
}
