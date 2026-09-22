<?php

declare(strict_types=1);

namespace ContextDev\Web\WebMapURLsResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type URLShape = array{
 *   url: string,
 *   description?: string|null,
 *   keywords?: list<string>|null,
 *   language?: string|null,
 *   title?: string|null,
 * }
 */
final class URL implements BaseModel
{
    /** @use SdkModel<URLShape> */
    use SdkModel;

    #[Required]
    public string $url;

    #[Optional]
    public ?string $description;

    /** @var list<string>|null $keywords */
    #[Optional(list: 'string')]
    public ?array $keywords;

    #[Optional]
    public ?string $language;

    #[Optional]
    public ?string $title;

    /**
     * `new URL()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * URL::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new URL)->withURL(...)
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
     * @param list<string>|null $keywords
     */
    public static function with(
        string $url,
        ?string $description = null,
        ?array $keywords = null,
        ?string $language = null,
        ?string $title = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $description && $self['description'] = $description;
        null !== $keywords && $self['keywords'] = $keywords;
        null !== $language && $self['language'] = $language;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param list<string> $keywords
     */
    public function withKeywords(array $keywords): self
    {
        $self = clone $this;
        $self['keywords'] = $keywords;

        return $self;
    }

    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
