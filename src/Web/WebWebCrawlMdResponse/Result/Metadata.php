<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebCrawlMdResponse\Result;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Core\Conversion\MapOf;
use ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\AdditionalMeta;
use ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\Alternate;
use ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\OpenGraph;
use ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\Twitter;

/**
 * @phpstan-import-type AdditionalMetaVariants from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\AdditionalMeta
 * @phpstan-import-type OpenGraphVariants from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\OpenGraph
 * @phpstan-import-type TwitterVariants from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\Twitter
 * @phpstan-import-type AdditionalMetaShape from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\AdditionalMeta
 * @phpstan-import-type AlternateShape from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\Alternate
 * @phpstan-import-type OpenGraphShape from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\OpenGraph
 * @phpstan-import-type TwitterShape from \ContextDev\Web\WebWebCrawlMdResponse\Result\Metadata\Twitter
 *
 * @phpstan-type MetadataShape = array{
 *   crawlDepth: int,
 *   finalURL: string,
 *   sourceURL: string,
 *   statusCode: int,
 *   success: bool,
 *   title: string,
 *   url: string,
 *   additionalMeta?: array<string,AdditionalMetaShape>|null,
 *   alternates?: list<Alternate|AlternateShape>|null,
 *   author?: string|null,
 *   canonicalURL?: string|null,
 *   description?: string|null,
 *   favicon?: string|null,
 *   image?: string|null,
 *   jsonLd?: list<array<string,mixed>>|null,
 *   keywords?: list<string>|null,
 *   language?: string|null,
 *   modifiedTime?: string|null,
 *   openGraph?: array<string,OpenGraphShape>|null,
 *   publishedTime?: string|null,
 *   robots?: string|null,
 *   siteName?: string|null,
 *   twitter?: array<string,TwitterShape>|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * Depth relative to the start URL. 0 = start URL, 1 = one link away.
     */
    #[Required]
    public int $crawlDepth;

    /**
     * Final URL scraped after redirects or scraper fallback, when known. Falls back to sourceUrl when unavailable.
     */
    #[Required('finalUrl')]
    public string $finalURL;

    /**
     * Original URL requested by the caller.
     */
    #[Required('sourceUrl')]
    public string $sourceURL;

    /**
     * HTTP status code of the response.
     */
    #[Required]
    public int $statusCode;

    /**
     * true if the page was fetched and parsed successfully.
     */
    #[Required]
    public bool $success;

    /**
     * Best page title extracted from the page (empty string if unavailable).
     */
    #[Required]
    public string $title;

    /**
     * The crawl URL fetched for this page.
     */
    #[Required]
    public string $url;

    /**
     * Additional non-social meta tags not promoted to top-level metadata fields.
     *
     * @var array<string,AdditionalMetaVariants>|null $additionalMeta
     */
    #[Optional(map: AdditionalMeta::class)]
    public ?array $additionalMeta;

    /**
     * Resolved alternate links from link rel=alternate tags.
     *
     * @var list<Alternate>|null $alternates
     */
    #[Optional(list: Alternate::class)]
    public ?array $alternates;

    /**
     * Author metadata, when present.
     */
    #[Optional]
    public ?string $author;

    /**
     * Resolved canonical URL, when present.
     */
    #[Optional('canonicalUrl')]
    public ?string $canonicalURL;

    /**
     * Best description extracted from standard, Open Graph, or Twitter metadata.
     */
    #[Optional]
    public ?string $description;

    /**
     * Resolved favicon URL, when present.
     */
    #[Optional]
    public ?string $favicon;

    /**
     * Primary resolved preview image from Open Graph, Twitter, or image metadata.
     */
    #[Optional]
    public ?string $image;

    /**
     * JSON-LD structured data blocks parsed from the page.
     *
     * @var list<array<string,mixed>>|null $jsonLd
     */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $jsonLd;

    /**
     * Keywords extracted from the page's keywords meta tag.
     *
     * @var list<string>|null $keywords
     */
    #[Optional(list: 'string')]
    public ?array $keywords;

    /**
     * Language extracted from html lang or language meta tags.
     */
    #[Optional]
    public ?string $language;

    /**
     * Modified timestamp/date from page metadata, when present.
     */
    #[Optional]
    public ?string $modifiedTime;

    /**
     * Open Graph metadata with the og: prefix removed and keys camel-cased.
     *
     * @var array<string,OpenGraphVariants>|null $openGraph
     */
    #[Optional(map: OpenGraph::class)]
    public ?array $openGraph;

    /**
     * Published timestamp/date from page metadata, when present.
     */
    #[Optional]
    public ?string $publishedTime;

    /**
     * Robots meta directive, when present.
     */
    #[Optional]
    public ?string $robots;

    /**
     * Site or application name from page metadata.
     */
    #[Optional]
    public ?string $siteName;

    /**
     * Twitter card metadata with the twitter: prefix removed and keys camel-cased.
     *
     * @var array<string,TwitterVariants>|null $twitter
     */
    #[Optional(map: Twitter::class)]
    public ?array $twitter;

    /**
     * `new Metadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Metadata::with(
     *   crawlDepth: ...,
     *   finalURL: ...,
     *   sourceURL: ...,
     *   statusCode: ...,
     *   success: ...,
     *   title: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Metadata)
     *   ->withCrawlDepth(...)
     *   ->withFinalURL(...)
     *   ->withSourceURL(...)
     *   ->withStatusCode(...)
     *   ->withSuccess(...)
     *   ->withTitle(...)
     *   ->withURL(...)
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
     * @param array<string,AdditionalMetaShape>|null $additionalMeta
     * @param list<Alternate|AlternateShape>|null $alternates
     * @param list<array<string,mixed>>|null $jsonLd
     * @param list<string>|null $keywords
     * @param array<string,OpenGraphShape>|null $openGraph
     * @param array<string,TwitterShape>|null $twitter
     */
    public static function with(
        int $crawlDepth,
        string $finalURL,
        string $sourceURL,
        int $statusCode,
        bool $success,
        string $title,
        string $url,
        ?array $additionalMeta = null,
        ?array $alternates = null,
        ?string $author = null,
        ?string $canonicalURL = null,
        ?string $description = null,
        ?string $favicon = null,
        ?string $image = null,
        ?array $jsonLd = null,
        ?array $keywords = null,
        ?string $language = null,
        ?string $modifiedTime = null,
        ?array $openGraph = null,
        ?string $publishedTime = null,
        ?string $robots = null,
        ?string $siteName = null,
        ?array $twitter = null,
    ): self {
        $self = new self;

        $self['crawlDepth'] = $crawlDepth;
        $self['finalURL'] = $finalURL;
        $self['sourceURL'] = $sourceURL;
        $self['statusCode'] = $statusCode;
        $self['success'] = $success;
        $self['title'] = $title;
        $self['url'] = $url;

        null !== $additionalMeta && $self['additionalMeta'] = $additionalMeta;
        null !== $alternates && $self['alternates'] = $alternates;
        null !== $author && $self['author'] = $author;
        null !== $canonicalURL && $self['canonicalURL'] = $canonicalURL;
        null !== $description && $self['description'] = $description;
        null !== $favicon && $self['favicon'] = $favicon;
        null !== $image && $self['image'] = $image;
        null !== $jsonLd && $self['jsonLd'] = $jsonLd;
        null !== $keywords && $self['keywords'] = $keywords;
        null !== $language && $self['language'] = $language;
        null !== $modifiedTime && $self['modifiedTime'] = $modifiedTime;
        null !== $openGraph && $self['openGraph'] = $openGraph;
        null !== $publishedTime && $self['publishedTime'] = $publishedTime;
        null !== $robots && $self['robots'] = $robots;
        null !== $siteName && $self['siteName'] = $siteName;
        null !== $twitter && $self['twitter'] = $twitter;

        return $self;
    }

    /**
     * Depth relative to the start URL. 0 = start URL, 1 = one link away.
     */
    public function withCrawlDepth(int $crawlDepth): self
    {
        $self = clone $this;
        $self['crawlDepth'] = $crawlDepth;

        return $self;
    }

    /**
     * Final URL scraped after redirects or scraper fallback, when known. Falls back to sourceUrl when unavailable.
     */
    public function withFinalURL(string $finalURL): self
    {
        $self = clone $this;
        $self['finalURL'] = $finalURL;

        return $self;
    }

    /**
     * Original URL requested by the caller.
     */
    public function withSourceURL(string $sourceURL): self
    {
        $self = clone $this;
        $self['sourceURL'] = $sourceURL;

        return $self;
    }

    /**
     * HTTP status code of the response.
     */
    public function withStatusCode(int $statusCode): self
    {
        $self = clone $this;
        $self['statusCode'] = $statusCode;

        return $self;
    }

    /**
     * true if the page was fetched and parsed successfully.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Best page title extracted from the page (empty string if unavailable).
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * The crawl URL fetched for this page.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Additional non-social meta tags not promoted to top-level metadata fields.
     *
     * @param array<string,AdditionalMetaShape> $additionalMeta
     */
    public function withAdditionalMeta(array $additionalMeta): self
    {
        $self = clone $this;
        $self['additionalMeta'] = $additionalMeta;

        return $self;
    }

    /**
     * Resolved alternate links from link rel=alternate tags.
     *
     * @param list<Alternate|AlternateShape> $alternates
     */
    public function withAlternates(array $alternates): self
    {
        $self = clone $this;
        $self['alternates'] = $alternates;

        return $self;
    }

    /**
     * Author metadata, when present.
     */
    public function withAuthor(string $author): self
    {
        $self = clone $this;
        $self['author'] = $author;

        return $self;
    }

    /**
     * Resolved canonical URL, when present.
     */
    public function withCanonicalURL(string $canonicalURL): self
    {
        $self = clone $this;
        $self['canonicalURL'] = $canonicalURL;

        return $self;
    }

    /**
     * Best description extracted from standard, Open Graph, or Twitter metadata.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Resolved favicon URL, when present.
     */
    public function withFavicon(string $favicon): self
    {
        $self = clone $this;
        $self['favicon'] = $favicon;

        return $self;
    }

    /**
     * Primary resolved preview image from Open Graph, Twitter, or image metadata.
     */
    public function withImage(string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * JSON-LD structured data blocks parsed from the page.
     *
     * @param list<array<string,mixed>> $jsonLd
     */
    public function withJsonLd(array $jsonLd): self
    {
        $self = clone $this;
        $self['jsonLd'] = $jsonLd;

        return $self;
    }

    /**
     * Keywords extracted from the page's keywords meta tag.
     *
     * @param list<string> $keywords
     */
    public function withKeywords(array $keywords): self
    {
        $self = clone $this;
        $self['keywords'] = $keywords;

        return $self;
    }

    /**
     * Language extracted from html lang or language meta tags.
     */
    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Modified timestamp/date from page metadata, when present.
     */
    public function withModifiedTime(string $modifiedTime): self
    {
        $self = clone $this;
        $self['modifiedTime'] = $modifiedTime;

        return $self;
    }

    /**
     * Open Graph metadata with the og: prefix removed and keys camel-cased.
     *
     * @param array<string,OpenGraphShape> $openGraph
     */
    public function withOpenGraph(array $openGraph): self
    {
        $self = clone $this;
        $self['openGraph'] = $openGraph;

        return $self;
    }

    /**
     * Published timestamp/date from page metadata, when present.
     */
    public function withPublishedTime(string $publishedTime): self
    {
        $self = clone $this;
        $self['publishedTime'] = $publishedTime;

        return $self;
    }

    /**
     * Robots meta directive, when present.
     */
    public function withRobots(string $robots): self
    {
        $self = clone $this;
        $self['robots'] = $robots;

        return $self;
    }

    /**
     * Site or application name from page metadata.
     */
    public function withSiteName(string $siteName): self
    {
        $self = clone $this;
        $self['siteName'] = $siteName;

        return $self;
    }

    /**
     * Twitter card metadata with the twitter: prefix removed and keys camel-cased.
     *
     * @param array<string,TwitterShape> $twitter
     */
    public function withTwitter(array $twitter): self
    {
        $self = clone $this;
        $self['twitter'] = $twitter;

        return $self;
    }
}
