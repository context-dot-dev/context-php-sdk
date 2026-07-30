<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchSubmitResponse\Code;
use ContextDev\Batch\BatchSubmitResponse\KeyMetadata;
use ContextDev\Batch\BatchSubmitResponse\Metadata;
use ContextDev\Batch\BatchSubmitResponse\Person;
use ContextDev\Batch\BatchSubmitResponse\Status;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MetadataShape from \ContextDev\Batch\BatchSubmitResponse\Metadata
 * @phpstan-import-type PersonShape from \ContextDev\Batch\BatchSubmitResponse\Person
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Batch\BatchSubmitResponse\KeyMetadata
 *
 * @phpstan-type BatchSubmitResponseShape = array{
 *   code: Code|value-of<Code>,
 *   metadata: Metadata|MetadataShape,
 *   person: Person|PersonShape,
 *   status: Status|value-of<Status>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class BatchSubmitResponse implements BaseModel
{
    /** @use SdkModel<BatchSubmitResponseShape> */
    use SdkModel;

    /**
     * HTTP status code.
     *
     * @var value-of<Code> $code
     */
    #[Required(enum: Code::class)]
    public int $code;

    /**
     * Additional response details.
     */
    #[Required]
    public Metadata $metadata;

    /**
     * Retrieved person profile.
     */
    #[Required]
    public Person $person;

    /**
     * Response status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new BatchSubmitResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchSubmitResponse::with(code: ..., metadata: ..., person: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchSubmitResponse)
     *   ->withCode(...)
     *   ->withMetadata(...)
     *   ->withPerson(...)
     *   ->withStatus(...)
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
     * @param Code|value-of<Code> $code
     * @param Metadata|MetadataShape $metadata
     * @param Person|PersonShape $person
     * @param Status|value-of<Status> $status
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        Code|int $code,
        Metadata|array $metadata,
        Person|array $person,
        Status|string $status,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['metadata'] = $metadata;
        $self['person'] = $person;
        $self['status'] = $status;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * HTTP status code.
     *
     * @param Code|value-of<Code> $code
     */
    public function withCode(Code|int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Additional response details.
     *
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Retrieved person profile.
     *
     * @param Person|PersonShape $person
     */
    public function withPerson(Person|array $person): self
    {
        $self = clone $this;
        $self['person'] = $person;

        return $self;
    }

    /**
     * Response status.
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
