<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorCreateParams\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Watch a sitemap and report URLs that are added or removed.
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

    /**
     * Use `sitemap` to watch a site for added or removed URLs.
     *
     * @var 'sitemap' $type
     */
    #[Required]
    public string $type = 'sitemap';

    /**
     * Public HTTP(S) URL of the sitemap to watch.
     */
    #[Required]
    public string $url;

    /**
     * Path patterns of URLs to ignore, such as `/legal/*`.
     *
     * @var list<string>|null $exclude
     */
    #[Optional(list: 'string')]
    public ?array $exclude;

    /**
     * Path patterns of URLs to track, such as `/blog/*`.
     *
     * @var list<string>|null $include
     */
    #[Optional(list: 'string')]
    public ?array $include;

    /**
     * Maximum number of URLs to track.
     */
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
     * Use `sitemap` to watch a site for added or removed URLs.
     *
     * @param 'sitemap' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Public HTTP(S) URL of the sitemap to watch.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Path patterns of URLs to ignore, such as `/legal/*`.
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
     * Path patterns of URLs to track, such as `/blog/*`.
     *
     * @param list<string> $include
     */
    public function withInclude(array $include): self
    {
        $self = clone $this;
        $self['include'] = $include;

        return $self;
    }

    /**
     * Maximum number of URLs to track.
     */
    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }
}
