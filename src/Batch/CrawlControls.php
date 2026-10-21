<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\CrawlControls\Languages;
use ContextDev\Batch\CrawlControls\Languages\UnionMember0;
use ContextDev\Batch\CrawlControls\Source\Sitemap;
use ContextDev\Batch\CrawlControls\Source\StartURL;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Crawl settings as submitted.
 *
 * @phpstan-import-type LanguagesVariants from \ContextDev\Batch\CrawlControls\Languages
 * @phpstan-import-type SourceVariants from \ContextDev\Batch\CrawlControls\Source
 * @phpstan-import-type LanguagesShape from \ContextDev\Batch\CrawlControls\Languages
 * @phpstan-import-type SourceShape from \ContextDev\Batch\CrawlControls\Source
 *
 * @phpstan-type CrawlControlsShape = array{
 *   excludeURLPattern: string|null,
 *   followSubdomains: bool,
 *   languages: LanguagesShape|null,
 *   maxDepth: int|null,
 *   maxPages: int,
 *   source: SourceShape,
 *   urlPattern: string|null,
 * }
 */
final class CrawlControls implements BaseModel
{
    /** @use SdkModel<CrawlControlsShape> */
    use SdkModel;

    /**
     * RE2 pattern URLs must not match to be crawled. Null when the crawl set none.
     */
    #[Required('exclude_url_pattern')]
    public ?string $excludeURLPattern;

    /**
     * Whether links to subdomains were followed. Always false for a sitemap crawl.
     */
    #[Required('follow_subdomains')]
    public bool $followSubdomains;

    /**
     * Languages whose pages were followed: `same_as_start_url` or a list of language codes. Null when every language was followed, which is always the case for a sitemap crawl.
     *
     * @var LanguagesVariants|null $languages
     */
    #[Required(union: Languages::class)]
    public array|string|null $languages;

    /**
     * Link depth limit. Always 0 for a sitemap crawl, which never follows links off its URLs; null when a `start_url` crawl set no limit.
     */
    #[Required('max_depth')]
    public ?int $maxDepth;

    /**
     * The `maxUrls` submitted with the crawl. A sitemap crawl scrapes only the URLs its sitemap actually lists, up to this many, so `input.reserved` is often lower.
     */
    #[Required('max_pages')]
    public int $maxPages;

    /**
     * Where the crawl started.
     *
     * @var SourceVariants $source
     */
    #[Required]
    public StartURL|Sitemap $source;

    /**
     * RE2 pattern URLs had to match to be crawled. Null when the crawl set none.
     */
    #[Required('url_pattern')]
    public ?string $urlPattern;

    /**
     * `new CrawlControls()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CrawlControls::with(
     *   excludeURLPattern: ...,
     *   followSubdomains: ...,
     *   languages: ...,
     *   maxDepth: ...,
     *   maxPages: ...,
     *   source: ...,
     *   urlPattern: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CrawlControls)
     *   ->withExcludeURLPattern(...)
     *   ->withFollowSubdomains(...)
     *   ->withLanguages(...)
     *   ->withMaxDepth(...)
     *   ->withMaxPages(...)
     *   ->withSource(...)
     *   ->withURLPattern(...)
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
     * @param LanguagesShape|null $languages
     * @param SourceShape $source
     */
    public static function with(
        ?string $excludeURLPattern,
        bool $followSubdomains,
        UnionMember0|array|string|null $languages,
        ?int $maxDepth,
        int $maxPages,
        StartURL|array|Sitemap $source,
        ?string $urlPattern,
    ): self {
        $self = new self;

        $self['excludeURLPattern'] = $excludeURLPattern;
        $self['followSubdomains'] = $followSubdomains;
        $self['languages'] = $languages;
        $self['maxDepth'] = $maxDepth;
        $self['maxPages'] = $maxPages;
        $self['source'] = $source;
        $self['urlPattern'] = $urlPattern;

        return $self;
    }

    /**
     * RE2 pattern URLs must not match to be crawled. Null when the crawl set none.
     */
    public function withExcludeURLPattern(?string $excludeURLPattern): self
    {
        $self = clone $this;
        $self['excludeURLPattern'] = $excludeURLPattern;

        return $self;
    }

    /**
     * Whether links to subdomains were followed. Always false for a sitemap crawl.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Languages whose pages were followed: `same_as_start_url` or a list of language codes. Null when every language was followed, which is always the case for a sitemap crawl.
     *
     * @param LanguagesShape|null $languages
     */
    public function withLanguages(
        UnionMember0|array|string|null $languages
    ): self {
        $self = clone $this;
        $self['languages'] = $languages;

        return $self;
    }

    /**
     * Link depth limit. Always 0 for a sitemap crawl, which never follows links off its URLs; null when a `start_url` crawl set no limit.
     */
    public function withMaxDepth(?int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * The `maxUrls` submitted with the crawl. A sitemap crawl scrapes only the URLs its sitemap actually lists, up to this many, so `input.reserved` is often lower.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * Where the crawl started.
     *
     * @param SourceShape $source
     */
    public function withSource(StartURL|array|Sitemap $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * RE2 pattern URLs had to match to be crawled. Null when the crawl set none.
     */
    public function withURLPattern(?string $urlPattern): self
    {
        $self = clone $this;
        $self['urlPattern'] = $urlPattern;

        return $self;
    }
}
