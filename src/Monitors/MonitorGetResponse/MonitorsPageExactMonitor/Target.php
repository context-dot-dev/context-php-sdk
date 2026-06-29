<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\MonitorsPageExactMonitor;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetResponse\MonitorsPageExactMonitor\Target\Type;

/**
 * @phpstan-type TargetShape = array{
 *   type: Type|value-of<Type>, url: string, normalizeWhitespace?: bool|null
 * }
 */
final class Target implements BaseModel
{
    /** @use SdkModel<TargetShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required]
    public string $url;

    /**
     * Normalize whitespace before comparing or analyzing text.
     */
    #[Optional('normalize_whitespace')]
    public ?bool $normalizeWhitespace;

    /**
     * `new Target()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Target::with(type: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Target)->withType(...)->withURL(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Type|string $type,
        string $url,
        ?bool $normalizeWhitespace = null
    ): self {
        $self = new self;

        $self['type'] = $type;
        $self['url'] = $url;

        null !== $normalizeWhitespace && $self['normalizeWhitespace'] = $normalizeWhitespace;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Normalize whitespace before comparing or analyzing text.
     */
    public function withNormalizeWhitespace(bool $normalizeWhitespace): self
    {
        $self = clone $this;
        $self['normalizeWhitespace'] = $normalizeWhitespace;

        return $self;
    }
}
