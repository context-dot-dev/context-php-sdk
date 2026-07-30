<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchSubmitParams\Identifiers;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve and normalize a person profile from identifiers.
 *
 * @see ContextDev\Services\BatchService::submit()
 *
 * @phpstan-import-type IdentifiersShape from \ContextDev\Batch\BatchSubmitParams\Identifiers
 *
 * @phpstan-type BatchSubmitParamsShape = array{
 *   identifiers: Identifiers|IdentifiersShape,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 * }
 */
final class BatchSubmitParams implements BaseModel
{
    /** @use SdkModel<BatchSubmitParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Known identifiers for the person. At least one identifier is required.
     */
    #[Required]
    public Identifiers $identifiers;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * `new BatchSubmitParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchSubmitParams::with(identifiers: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchSubmitParams)->withIdentifiers(...)
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
     * @param Identifiers|IdentifiersShape $identifiers
     * @param list<string>|null $tags
     */
    public static function with(
        Identifiers|array $identifiers,
        ?array $tags = null,
        ?int $timeoutMs = null
    ): self {
        $self = new self;

        $self['identifiers'] = $identifiers;

        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Known identifiers for the person. At least one identifier is required.
     *
     * @param Identifiers|IdentifiersShape $identifiers
     */
    public function withIdentifiers(Identifiers|array $identifiers): self
    {
        $self = clone $this;
        $self['identifiers'] = $identifiers;

        return $self;
    }

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
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
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
