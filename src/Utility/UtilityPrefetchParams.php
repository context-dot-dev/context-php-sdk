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
use ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts;
use ContextDev\Utility\UtilityPrefetchParams\Type;

/**
 * Queue brand or styleguide data so a later lookup can return sooner.
 *
 * @see ContextDev\Services\UtilityService::prefetch()
 *
 * @phpstan-import-type IdentifierVariants from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 * @phpstan-import-type IdentifierShape from \ContextDev\Utility\UtilityPrefetchParams\Identifier
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Utility\UtilityPrefetchParams\TimeoutOpts
 *
 * @phpstan-type UtilityPrefetchParamsShape = array{
 *   identifier: IdentifierShape,
 *   type: Type|value-of<Type>,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
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
     * Data to prefetch.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

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
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     */
    public static function with(
        UtilityPrefetchDomainIdentifier|array|UtilityPrefetchEmailIdentifier $identifier,
        Type|string $type,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
    ): self {
        $self = new self;

        $self['identifier'] = $identifier;
        $self['type'] = $type;

        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;

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
     * Data to prefetch.
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
     * Labels for filtering usage in the dashboard.
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
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }
}
