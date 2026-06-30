<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorCreateParams\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Watch a sitemap for URL additions and removals.
 *
 * @phpstan-type MonitorsSitemapTargetShape = array{
 *   type: 'sitemap',
 *   url: string,
 *   exclude?: list<string>|null,
 *   include?: list<string>|null,
 *   maxURLs?: int|null,
 * }
 */
final class MonitorsSitemapTarget implements BaseModel
{
    /** @use SdkModel<MonitorsSitemapTargetShape> */
    use SdkModel;

    /** @var 'sitemap' $type */
    #[Required]
    public string $type = 'sitemap';

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
     * `new MonitorsSitemapTarget()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSitemapTarget::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsSitemapTarget)->withURL(...)
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
     * @param list<string>|null $exclude
     * @param list<string>|null $include
     */
    public static function with(
        string $url,
        ?array $exclude = null,
        ?array $include = null,
        ?int $maxURLs = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $exclude && $self['exclude'] = $exclude;
        null !== $include && $self['include'] = $include;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;

        return $self;
    }

    /**
     * @param 'sitemap' $type
     */
    public function withType(string $type): self
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
