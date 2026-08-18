<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchResponse\Data\Match_;
use ContextDev\News\NewsSearchResponse\Data\Source;
use ContextDev\News\NewsSearchResponse\Data\Type;

/**
 * @phpstan-import-type MatchShape from \ContextDev\News\NewsSearchResponse\Data\Match_
 * @phpstan-import-type SourceShape from \ContextDev\News\NewsSearchResponse\Data\Source
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   authors: list<string>,
 *   description: string|null,
 *   imageURL: string|null,
 *   language: string|null,
 *   match: Match_|MatchShape,
 *   publishedAt: \DateTimeInterface|null,
 *   source: Source|SourceShape,
 *   storyID: string,
 *   title: string,
 *   type: Type|value-of<Type>,
 *   url: string,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Stable unique identifier for this article. Use it to deduplicate or reference an article across requests.
     */
    #[Required]
    public string $id;

    /**
     * Bylined authors. Empty when no byline is available.
     *
     * @var list<string> $authors
     */
    #[Required(list: 'string')]
    public array $authors;

    /**
     * Short summary or excerpt of the article, when the publisher provides one.
     */
    #[Required]
    public ?string $description;

    /**
     * Lead image for the article, when one is available.
     */
    #[Required('image_url')]
    public ?string $imageURL;

    /**
     * Language the article is written in, as a lowercase ISO 639-1 code such as en. Null when unknown.
     */
    #[Required]
    public ?string $language;

    /**
     * How the article relates to the company you searched for.
     */
    #[Required]
    public Match_ $match;

    /**
     * When the article was published, as an ISO 8601 timestamp. Null when the publisher does not state a reliable date.
     */
    #[Required('published_at')]
    public ?\DateTimeInterface $publishedAt;

    /**
     * The publication that published the article.
     */
    #[Required]
    public Source $source;

    /**
     * Shared by articles covering the same story on the same day. Use it to group or collapse syndicated copies of one announcement across outlets.
     */
    #[Required('story_id')]
    public string $storyID;

    /**
     * Article headline.
     */
    #[Required]
    public string $title;

    /**
     * Kind of coverage. Use it to separate independent reporting (editorial) from company-issued content (press_release, regulatory_filing, advisory).
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Link to the article on the publisher site.
     */
    #[Required]
    public string $url;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   authors: ...,
     *   description: ...,
     *   imageURL: ...,
     *   language: ...,
     *   match: ...,
     *   publishedAt: ...,
     *   source: ...,
     *   storyID: ...,
     *   title: ...,
     *   type: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withID(...)
     *   ->withAuthors(...)
     *   ->withDescription(...)
     *   ->withImageURL(...)
     *   ->withLanguage(...)
     *   ->withMatch(...)
     *   ->withPublishedAt(...)
     *   ->withSource(...)
     *   ->withStoryID(...)
     *   ->withTitle(...)
     *   ->withType(...)
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
     * @param list<string> $authors
     * @param Match_|MatchShape $match
     * @param Source|SourceShape $source
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        array $authors,
        ?string $description,
        ?string $imageURL,
        ?string $language,
        Match_|array $match,
        ?\DateTimeInterface $publishedAt,
        Source|array $source,
        string $storyID,
        string $title,
        Type|string $type,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['authors'] = $authors;
        $self['description'] = $description;
        $self['imageURL'] = $imageURL;
        $self['language'] = $language;
        $self['match'] = $match;
        $self['publishedAt'] = $publishedAt;
        $self['source'] = $source;
        $self['storyID'] = $storyID;
        $self['title'] = $title;
        $self['type'] = $type;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Stable unique identifier for this article. Use it to deduplicate or reference an article across requests.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Bylined authors. Empty when no byline is available.
     *
     * @param list<string> $authors
     */
    public function withAuthors(array $authors): self
    {
        $self = clone $this;
        $self['authors'] = $authors;

        return $self;
    }

    /**
     * Short summary or excerpt of the article, when the publisher provides one.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Lead image for the article, when one is available.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * Language the article is written in, as a lowercase ISO 639-1 code such as en. Null when unknown.
     */
    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * How the article relates to the company you searched for.
     *
     * @param Match_|MatchShape $match
     */
    public function withMatch(Match_|array $match): self
    {
        $self = clone $this;
        $self['match'] = $match;

        return $self;
    }

    /**
     * When the article was published, as an ISO 8601 timestamp. Null when the publisher does not state a reliable date.
     */
    public function withPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * The publication that published the article.
     *
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Shared by articles covering the same story on the same day. Use it to group or collapse syndicated copies of one announcement across outlets.
     */
    public function withStoryID(string $storyID): self
    {
        $self = clone $this;
        $self['storyID'] = $storyID;

        return $self;
    }

    /**
     * Article headline.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Kind of coverage. Use it to separate independent reporting (editorial) from company-issued content (press_release, regulatory_filing, advisory).
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
     * Link to the article on the publisher site.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
