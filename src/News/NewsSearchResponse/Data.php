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

    #[Required]
    public string $id;

    /** @var list<string> $authors */
    #[Required(list: 'string')]
    public array $authors;

    #[Required]
    public ?string $description;

    #[Required('image_url')]
    public ?string $imageURL;

    #[Required]
    public ?string $language;

    #[Required]
    public Match_ $match;

    #[Required('published_at')]
    public ?\DateTimeInterface $publishedAt;

    #[Required]
    public Source $source;

    /**
     * Groups matching normalized headlines published on the same UTC day.
     */
    #[Required('story_id')]
    public string $storyID;

    #[Required]
    public string $title;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

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

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param list<string> $authors
     */
    public function withAuthors(array $authors): self
    {
        $self = clone $this;
        $self['authors'] = $authors;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    public function withLanguage(?string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * @param Match_|MatchShape $match
     */
    public function withMatch(Match_|array $match): self
    {
        $self = clone $this;
        $self['match'] = $match;

        return $self;
    }

    public function withPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Groups matching normalized headlines published on the same UTC day.
     */
    public function withStoryID(string $storyID): self
    {
        $self = clone $this;
        $self['storyID'] = $storyID;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

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

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
