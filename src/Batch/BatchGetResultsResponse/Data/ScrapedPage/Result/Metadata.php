<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result;

use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\AdditionalMeta;
use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Alternate;
use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Heading;
use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\OpenGraph;
use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Twitter;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Core\Conversion\MapOf;

/**
 * Page metadata. Fields are omitted when not found.
 *
 * @phpstan-import-type AdditionalMetaVariants from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\AdditionalMeta
 * @phpstan-import-type OpenGraphVariants from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\OpenGraph
 * @phpstan-import-type TwitterVariants from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Twitter
 * @phpstan-import-type AdditionalMetaShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\AdditionalMeta
 * @phpstan-import-type AlternateShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Alternate
 * @phpstan-import-type HeadingShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Heading
 * @phpstan-import-type OpenGraphShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\OpenGraph
 * @phpstan-import-type TwitterShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Metadata\Twitter
 *
 * @phpstan-type MetadataShape = array{
 *   additionalMeta?: array<string,AdditionalMetaShape>|null,
 *   alternates?: list<Alternate|AlternateShape>|null,
 *   author?: string|null,
 *   canonicalURL?: string|null,
 *   description?: string|null,
 *   favicon?: string|null,
 *   headings?: list<Heading|HeadingShape>|null,
 *   image?: string|null,
 *   jsonLd?: list<array<string,mixed>>|null,
 *   keywords?: list<string>|null,
 *   language?: string|null,
 *   modifiedTime?: string|null,
 *   openGraph?: array<string,OpenGraphShape>|null,
 *   publishedTime?: string|null,
 *   robots?: string|null,
 *   siteName?: string|null,
 *   title?: string|null,
 *   twitter?: array<string,TwitterShape>|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    /**
     * Other non-social meta tags that don't have their own field.
     *
     * @var array<string,AdditionalMetaVariants>|null $additionalMeta
     */
    #[Optional(map: AdditionalMeta::class)]
    public ?array $additionalMeta;

    /**
     * Alternate links from `link rel="alternate"` tags, as absolute URLs.
     *
     * @var list<Alternate>|null $alternates
     */
    #[Optional(list: Alternate::class)]
    public ?array $alternates;

    /**
     * Author, when present.
     */
    #[Optional]
    public ?string $author;

    /**
     * Absolute canonical URL, when present.
     */
    #[Optional('canonicalUrl')]
    public ?string $canonicalURL;

    /**
     * Best available description, from standard, Open Graph, or Twitter meta tags.
     */
    #[Optional]
    public ?string $description;

    /**
     * Absolute favicon URL, when present.
     */
    #[Optional]
    public ?string $favicon;

    /**
     * Headings (`h1` to `h6`) in document order, from the full page before any filtering. Up to 500. Omitted when the page has none.
     *
     * @var list<Heading>|null $headings
     */
    #[Optional(list: Heading::class)]
    public ?array $headings;

    /**
     * Main preview image URL, from Open Graph, Twitter, or image meta tags.
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
     * Keywords from the page's `keywords` meta tag.
     *
     * @var list<string>|null $keywords
     */
    #[Optional(list: 'string')]
    public ?array $keywords;

    /**
     * Page language, from the `html` `lang` attribute or language meta tags.
     */
    #[Optional]
    public ?string $language;

    /**
     * Last-modified date or timestamp from page metadata, when present.
     */
    #[Optional]
    public ?string $modifiedTime;

    /**
     * Open Graph tags, with the `og:` prefix removed and keys in camelCase.
     *
     * @var array<string,OpenGraphVariants>|null $openGraph
     */
    #[Optional(map: OpenGraph::class)]
    public ?array $openGraph;

    /**
     * Publish date or timestamp from page metadata, when present.
     */
    #[Optional]
    public ?string $publishedTime;

    /**
     * `robots` meta directive, when present.
     */
    #[Optional]
    public ?string $robots;

    /**
     * Site or app name from page metadata.
     */
    #[Optional]
    public ?string $siteName;

    /**
     * Best available page title.
     */
    #[Optional]
    public ?string $title;

    /**
     * Twitter card tags, with the `twitter:` prefix removed and keys in camelCase.
     *
     * @var array<string,TwitterVariants>|null $twitter
     */
    #[Optional(map: Twitter::class)]
    public ?array $twitter;

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
     * @param list<Heading|HeadingShape>|null $headings
     * @param list<array<string,mixed>>|null $jsonLd
     * @param list<string>|null $keywords
     * @param array<string,OpenGraphShape>|null $openGraph
     * @param array<string,TwitterShape>|null $twitter
     */
    public static function with(
        ?array $additionalMeta = null,
        ?array $alternates = null,
        ?string $author = null,
        ?string $canonicalURL = null,
        ?string $description = null,
        ?string $favicon = null,
        ?array $headings = null,
        ?string $image = null,
        ?array $jsonLd = null,
        ?array $keywords = null,
        ?string $language = null,
        ?string $modifiedTime = null,
        ?array $openGraph = null,
        ?string $publishedTime = null,
        ?string $robots = null,
        ?string $siteName = null,
        ?string $title = null,
        ?array $twitter = null,
    ): self {
        $self = new self;

        null !== $additionalMeta && $self['additionalMeta'] = $additionalMeta;
        null !== $alternates && $self['alternates'] = $alternates;
        null !== $author && $self['author'] = $author;
        null !== $canonicalURL && $self['canonicalURL'] = $canonicalURL;
        null !== $description && $self['description'] = $description;
        null !== $favicon && $self['favicon'] = $favicon;
        null !== $headings && $self['headings'] = $headings;
        null !== $image && $self['image'] = $image;
        null !== $jsonLd && $self['jsonLd'] = $jsonLd;
        null !== $keywords && $self['keywords'] = $keywords;
        null !== $language && $self['language'] = $language;
        null !== $modifiedTime && $self['modifiedTime'] = $modifiedTime;
        null !== $openGraph && $self['openGraph'] = $openGraph;
        null !== $publishedTime && $self['publishedTime'] = $publishedTime;
        null !== $robots && $self['robots'] = $robots;
        null !== $siteName && $self['siteName'] = $siteName;
        null !== $title && $self['title'] = $title;
        null !== $twitter && $self['twitter'] = $twitter;

        return $self;
    }

    /**
     * Other non-social meta tags that don't have their own field.
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
     * Alternate links from `link rel="alternate"` tags, as absolute URLs.
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
     * Author, when present.
     */
    public function withAuthor(string $author): self
    {
        $self = clone $this;
        $self['author'] = $author;

        return $self;
    }

    /**
     * Absolute canonical URL, when present.
     */
    public function withCanonicalURL(string $canonicalURL): self
    {
        $self = clone $this;
        $self['canonicalURL'] = $canonicalURL;

        return $self;
    }

    /**
     * Best available description, from standard, Open Graph, or Twitter meta tags.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Absolute favicon URL, when present.
     */
    public function withFavicon(string $favicon): self
    {
        $self = clone $this;
        $self['favicon'] = $favicon;

        return $self;
    }

    /**
     * Headings (`h1` to `h6`) in document order, from the full page before any filtering. Up to 500. Omitted when the page has none.
     *
     * @param list<Heading|HeadingShape> $headings
     */
    public function withHeadings(array $headings): self
    {
        $self = clone $this;
        $self['headings'] = $headings;

        return $self;
    }

    /**
     * Main preview image URL, from Open Graph, Twitter, or image meta tags.
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
     * Keywords from the page's `keywords` meta tag.
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
     * Page language, from the `html` `lang` attribute or language meta tags.
     */
    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Last-modified date or timestamp from page metadata, when present.
     */
    public function withModifiedTime(string $modifiedTime): self
    {
        $self = clone $this;
        $self['modifiedTime'] = $modifiedTime;

        return $self;
    }

    /**
     * Open Graph tags, with the `og:` prefix removed and keys in camelCase.
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
     * Publish date or timestamp from page metadata, when present.
     */
    public function withPublishedTime(string $publishedTime): self
    {
        $self = clone $this;
        $self['publishedTime'] = $publishedTime;

        return $self;
    }

    /**
     * `robots` meta directive, when present.
     */
    public function withRobots(string $robots): self
    {
        $self = clone $this;
        $self['robots'] = $robots;

        return $self;
    }

    /**
     * Site or app name from page metadata.
     */
    public function withSiteName(string $siteName): self
    {
        $self = clone $this;
        $self['siteName'] = $siteName;

        return $self;
    }

    /**
     * Best available page title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Twitter card tags, with the `twitter:` prefix removed and keys in camelCase.
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
