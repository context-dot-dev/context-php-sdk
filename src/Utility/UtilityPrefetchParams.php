<?php

declare(strict_types=1);

namespace ContextDev\Utility;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchDomainIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\Identifier\UtilityPrefetchEmailIdentifier;
use ContextDev\Utility\UtilityPrefetchParams\Type;

/**
 * Signal that you may fetch data soon to improve latency. The type field selects what to prefetch ('brand' queues a brand data fetch, 'styleguide' queues a styleguide extraction) and identifier carries exactly one lookup key: a domain, or an email whose domain is extracted and validated (free email providers and disposable email addresses are not allowed).
 *
 * @see ContextDev\Services\UtilityService::prefetch()
 *
 * @phpstan-import-type IdentifierVariants from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 *
 * @phpstan-type UtilityPrefetchParamsShape = array{
 *   identifier: IdentifierShape,
 *   type: Type|value-of<Type>,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 * }
 */
final class UtilityPrefetchParams implements BaseModel
{
    /** @use SdkModel<UtilityPrefetchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Identifier of the target to prefetch. Provide exactly one of domain or email.
     *
     * @var IdentifierVariants $identifier
     */
    #[Required]
    public UtilityPrefetchDomainIdentifier|UtilityPrefetchEmailIdentifier $identifier;

    /**
     * What to prefetch: 'brand' warms the brand data cache, 'styleguide' warms the styleguide cache.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

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
     * `new UtilityPrefetchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UtilityPrefetchParams::with(identifier: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UtilityPrefetchParams)->withIdentifier(...)->withType(...)
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
     * @param IdentifierShape $identifier
     * @param Type|value-of<Type> $type
     * @param list<string>|null $tags
     */
    public static function with(
        UtilityPrefetchDomainIdentifier|array|UtilityPrefetchEmailIdentifier $identifier,
        Type|string $type,
        ?array $tags = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['identifier'] = $identifier;
        $self['type'] = $type;

        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Identifier of the target to prefetch. Provide exactly one of domain or email.
     *
     * @param IdentifierShape $identifier
     */
    public function withIdentifier(
        UtilityPrefetchDomainIdentifier|array|UtilityPrefetchEmailIdentifier $identifier,
    ): self {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * What to prefetch: 'brand' warms the brand data cache, 'styleguide' warms the styleguide cache.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
