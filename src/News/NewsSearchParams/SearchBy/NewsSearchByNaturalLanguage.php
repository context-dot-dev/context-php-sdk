<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Search all news with a plain-language query. Returns up to 100 matches, ordered by relevance.
 *
 * @phpstan-type NewsSearchByNaturalLanguageShape = array{
 *   query: string, type: 'natural_language'
 * }
 */
final class NewsSearchByNaturalLanguage implements BaseModel
{
    /** @use SdkModel<NewsSearchByNaturalLanguageShape> */
    use SdkModel;

    /**
     * Use `natural_language` to search all news with a plain-language query.
     *
     * @var 'natural_language' $type
     */
    #[Required]
    public string $type = 'natural_language';

    /**
     * What to search for, in plain language, such as "chip export restrictions to China".
     */
    #[Required]
    public string $query;

    /**
     * `new NewsSearchByNaturalLanguage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchByNaturalLanguage::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchByNaturalLanguage)->withQuery(...)
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
     */
    public static function with(string $query): self
    {
        $self = new self;

        $self['query'] = $query;

        return $self;
    }

    /**
     * What to search for, in plain language, such as "chip export restrictions to China".
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Use `natural_language` to search all news with a plain-language query.
     *
     * @param 'natural_language' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
