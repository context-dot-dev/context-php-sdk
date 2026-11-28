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
 *   match: null|Match_|MatchShape,
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
     * Unique ID of the article. It stays the same across requests, so you can use it to deduplicate.
     */
    #[Required]
    public string $id;

    /**
     * Authors named in the byline. Empty when there is no byline.
     *
     * @var list<string> $authors
     */
    #[Required(list: 'string')]
    public array $authors;

    /**
     * Summary or excerpt of the article. For natural-language searches, it includes the matching passages, up to 2,000 characters.
     */
    #[Required]
    public ?string $description;

    /**
     * URL of the article's lead image. `null` when there is none.
     */
    #[Required('image_url')]
    public ?string $imageURL;

    /**
     * Language of the article, as an ISO 639-1 code such as `en`. `null` when unknown.
     */
    #[Required]
    public ?string $language;

    /**
     * How the article relates to the company you searched for. `null` for natural-language searches.
     */
    #[Required]
    public ?Match_ $match;

    /**
     * When the article was published. `null` when the publisher does not give a reliable date.
     */
    #[Required('published_at')]
    public ?\DateTimeInterface $publishedAt;

    /**
     * Publication that published the article.
     */
    #[Required]
    public Source $source;

    /**
     * ID shared by articles that cover the same story on the same day. Use it to group syndicated copies of one announcement across outlets.
     */
    #[Required('story_id')]
    public string $storyID;

    /**
     * Headline of the article.
     */
    #[Required]
    public string $title;

    /**
     * Type of coverage. Use it to separate independent reporting (`editorial`) from company-issued content (`press_release`, `regulatory_filing`, `advisory`).
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * URL of the article on the publisher's site.
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
     * @param Match_|MatchShape|null $match
     * @param Source|SourceShape $source
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        array $authors,
        ?string $description,
        ?string $imageURL,
        ?string $language,
        Match_|array|null $match,
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
     * Unique ID of the article. It stays the same across requests, so you can use it to deduplicate.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Authors named in the byline. Empty when there is no byline.
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
     * Summary or excerpt of the article. For natural-language searches, it includes the matching passages, up to 2,000 characters.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * URL of the article's lead image. `null` when there is none.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * Language of the article, as an ISO 639-1 code such as `en`. `null` when unknown.
     */
    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * How the article relates to the company you searched for. `null` for natural-language searches.
     *
     * @param Match_|MatchShape|null $match
     */
    public function withMatch(Match_|array|null $match): self
    {
        $self = clone $this;
        $self['match'] = $match;

        return $self;
    }

    /**
     * When the article was published. `null` when the publisher does not give a reliable date.
     */
    public function withPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * Publication that published the article.
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
     * ID shared by articles that cover the same story on the same day. Use it to group syndicated copies of one announcement across outlets.
     */
    public function withStoryID(string $storyID): self
    {
        $self = clone $this;
        $self['storyID'] = $storyID;

        return $self;
    }

    /**
     * Headline of the article.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Type of coverage. Use it to separate independent reporting (`editorial`) from company-issued content (`press_release`, `regulatory_filing`, `advisory`).
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
     * URL of the article on the publisher's site.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
