<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\Sitemap\Controls;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Scrape the pages listed in a domain's sitemap. Links on those pages are not followed.
 *
 * @phpstan-import-type ControlsShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\Sitemap\Controls
 *
 * @phpstan-type SitemapShape = array{
 *   domain: string, type: 'sitemap', controls?: null|Controls|ControlsShape
 * }
 */
final class Sitemap implements BaseModel
{
    /** @use SdkModel<SitemapShape> */
    use SdkModel;

    /**
     * Scrape the URLs in the domain's sitemap.
     *
     * @var 'sitemap' $type
     */
    #[Required]
    public string $type = 'sitemap';

    /**
     * Domain whose sitemap lists the pages to scrape. A full URL is reduced to its domain.
     */
    #[Required]
    public string $domain;

    /**
     * Limits and filters for the sitemap URLs. A sitemap batch scrapes exactly those URLs and never follows links off them, so there is no crawl depth here.
     */
    #[Optional]
    public ?Controls $controls;

    /**
     * `new Sitemap()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Sitemap::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Sitemap)->withDomain(...)
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
     * @param Controls|ControlsShape|null $controls
     */
    public static function with(
        string $domain,
        Controls|array|null $controls = null
    ): self {
        $self = new self;

        $self['domain'] = $domain;

        null !== $controls && $self['controls'] = $controls;

        return $self;
    }

    /**
     * Domain whose sitemap lists the pages to scrape. A full URL is reduced to its domain.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Scrape the URLs in the domain's sitemap.
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
     * Limits and filters for the sitemap URLs. A sitemap batch scrapes exactly those URLs and never follows links off them, so there is no crawl depth here.
     *
     * @param Controls|ControlsShape $controls
     */
    public function withControls(Controls|array $controls): self
    {
        $self = clone $this;
        $self['controls'] = $controls;

        return $self;
    }
}
