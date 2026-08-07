<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls\Source;

use ContextDev\Batch\CrawlControls\Source\Sitemap\Type;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * The crawl scraped the pages listed in the domain's sitemap.
 *
 * @phpstan-type SitemapShape = array{domain: string, type: Type|value-of<Type>}
 */
final class Sitemap implements BaseModel
{
    /** @use SdkModel<SitemapShape> */
    use SdkModel;

    /**
     * Domain whose sitemap supplied the pages.
     */
    #[Required]
    public string $domain;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Sitemap()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Sitemap::with(domain: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Sitemap)->withDomain(...)->withType(...)
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
    public static function with(string $domain, Type|string $type): self
    {
        $self = new self;

        $self['domain'] = $domain;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Domain whose sitemap supplied the pages.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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
}
