<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\MonitorsSitemapExactMonitor;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsSitemapExactMonitor\Target\Type;

/**
 * @phpstan-type TargetShape = array{
 *   type: Type|value-of<Type>,
 *   url: string,
 *   exclude?: list<string>|null,
 *   include?: list<string>|null,
 *   maxURLs?: int|null,
 * }
 */
final class Target implements BaseModel
{
    /** @use SdkModel<TargetShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Sitemap URL to monitor.
     */
    #[Required]
    public string $url;

    /**
     * URL path patterns to exclude.
     *
     * @var list<string>|null $exclude
     */
    #[Optional(list: 'string')]
    public ?array $exclude;

    /**
     * URL path patterns to include.
     *
     * @var list<string>|null $include
     */
    #[Optional(list: 'string')]
    public ?array $include;

    #[Optional('max_urls')]
    public ?int $maxURLs;

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
     * @param list<string>|null $exclude
     * @param list<string>|null $include
     */
    public static function with(
        Type|string $type,
        string $url,
        ?array $exclude = null,
        ?array $include = null,
        ?int $maxURLs = null,
    ): self {
        $self = new self;

        $self['type'] = $type;
        $self['url'] = $url;

        null !== $exclude && $self['exclude'] = $exclude;
        null !== $include && $self['include'] = $include;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;

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

    /**
     * Sitemap URL to monitor.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * URL path patterns to exclude.
     *
     * @param list<string> $exclude
     */
    public function withExclude(array $exclude): self
    {
        $self = clone $this;
        $self['exclude'] = $exclude;

        return $self;
    }

    /**
     * URL path patterns to include.
     *
     * @param list<string> $include
     */
    public function withInclude(array $include): self
    {
        $self = clone $this;
        $self['include'] = $include;

        return $self;
    }

    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }
}
