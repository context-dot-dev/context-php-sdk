<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandSearchParams\Country;
use ContextDev\Brand\BrandSearchParams\Language;
use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Find up to 10 brands by name or domain, ordered by popularity. Optionally filter by country and primary language; both filters must match when provided together. Results include description, country, and language when available. Use the returned domain to retrieve a full brand profile.
 *
 * @see ContextDev\Services\BrandService::search()
 *
 * @phpstan-type BrandSearchParamsShape = array{
 *   query: string,
 *   autocomplete?: bool|null,
 *   country?: null|Country|value-of<Country>,
 *   language?: null|Language|value-of<Language>,
 *   queryBy?: list<QueryBy|value-of<QueryBy>>|null,
 *   tags?: list<string>|null,
 *   typoTolerance?: int|null,
 * }
 */
final class BrandSearchParams implements BaseModel
{
    /** @use SdkModel<BrandSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search term, matched against the fields selected by queryBy (e.g. 'nike', 'nike.com', 'nik').
     */
    #[Required]
    public string $query;

    /**
     * Whether the search term matches by prefix, so partial words match as they are typed (e.g. 'nik' matches Nike). Set to false to match whole words only.
     */
    #[Optional]
    public ?bool $autocomplete;

    /**
     * Only return brands in this country, as an uppercase ISO 3166-1 alpha-2 code such as US or GB.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Only return brands with this primary language, such as english or french.
     *
     * @var value-of<Language>|null $language
     */
    #[Optional(enum: Language::class)]
    public ?string $language;

    /**
     * Fields to match the search term against, as a comma-separated list or repeated parameter: 'name', 'domain', or both. Defaults to both.
     *
     * @var list<value-of<QueryBy>>|null $queryBy
     */
    #[Optional(list: QueryBy::class)]
    public ?array $queryBy;

    /**
     * Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Maximum number of typos tolerated when matching, from 0 to 2. Defaults to 0 (no typo tolerance).
     */
    #[Optional]
    public ?int $typoTolerance;

    /**
     * `new BrandSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSearchParams)->withQuery(...)
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
     * @param Country|value-of<Country>|null $country
     * @param Language|value-of<Language>|null $language
     * @param list<QueryBy|value-of<QueryBy>>|null $queryBy
     * @param list<string>|null $tags
     */
    public static function with(
        string $query,
        ?bool $autocomplete = null,
        Country|string|null $country = null,
        Language|string|null $language = null,
        ?array $queryBy = null,
        ?array $tags = null,
        ?int $typoTolerance = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $autocomplete && $self['autocomplete'] = $autocomplete;
        null !== $country && $self['country'] = $country;
        null !== $language && $self['language'] = $language;
        null !== $queryBy && $self['queryBy'] = $queryBy;
        null !== $tags && $self['tags'] = $tags;
        null !== $typoTolerance && $self['typoTolerance'] = $typoTolerance;

        return $self;
    }

    /**
     * Search term, matched against the fields selected by queryBy (e.g. 'nike', 'nike.com', 'nik').
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Whether the search term matches by prefix, so partial words match as they are typed (e.g. 'nik' matches Nike). Set to false to match whole words only.
     */
    public function withAutocomplete(bool $autocomplete): self
    {
        $self = clone $this;
        $self['autocomplete'] = $autocomplete;

        return $self;
    }

    /**
     * Only return brands in this country, as an uppercase ISO 3166-1 alpha-2 code such as US or GB.
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Only return brands with this primary language, such as english or french.
     *
     * @param Language|value-of<Language> $language
     */
    public function withLanguage(Language|string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }

    /**
     * Fields to match the search term against, as a comma-separated list or repeated parameter: 'name', 'domain', or both. Defaults to both.
     *
     * @param list<QueryBy|value-of<QueryBy>> $queryBy
     */
    public function withQueryBy(array $queryBy): self
    {
        $self = clone $this;
        $self['queryBy'] = $queryBy;

        return $self;
    }

    /**
     * Comma-separated labels for filtering usage, e.g. `production,team-alpha`.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Maximum number of typos tolerated when matching, from 0 to 2. Defaults to 0 (no typo tolerance).
     */
    public function withTypoTolerance(int $typoTolerance): self
    {
        $self = clone $this;
        $self['typoTolerance'] = $typoTolerance;

        return $self;
    }
}
