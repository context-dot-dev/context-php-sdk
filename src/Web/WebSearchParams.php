<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchParams\Country;
use ContextDev\Web\WebSearchParams\Freshness;
use ContextDev\Web\WebSearchParams\HighlightsOptions;
use ContextDev\Web\WebSearchParams\Languages;
use ContextDev\Web\WebSearchParams\Languages\UnionMember0;
use ContextDev\Web\WebSearchParams\MarkdownOptions;
use ContextDev\Web\WebSearchParams\TimeoutOpts;
use ContextDev\Web\WebSearchParams\Zdr;

/**
 * Search the web and get ranked results, with optional page Markdown or query-relevant passages for each one. Supports search operators and filters for domain, freshness, country, and language.
 *
 * @see ContextDev\Services\WebService::search()
 *
 * @phpstan-import-type LanguagesVariants from \ContextDev\Web\WebSearchParams\Languages
 * @phpstan-import-type HighlightsOptionsShape from \ContextDev\Web\WebSearchParams\HighlightsOptions
 * @phpstan-import-type LanguagesShape from \ContextDev\Web\WebSearchParams\Languages
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebSearchParams\TimeoutOpts
 *
 * @phpstan-type WebSearchParamsShape = array{
 *   query: string,
 *   country?: null|Country|value-of<Country>,
 *   descriptionMaxCharacters?: int|null,
 *   excludeDomains?: list<string>|null,
 *   freshness?: null|Freshness|value-of<Freshness>,
 *   highlightsOptions?: null|HighlightsOptions|HighlightsOptionsShape,
 *   includeDomains?: list<string>|null,
 *   languages?: LanguagesShape|null,
 *   markdownOptions?: null|MarkdownOptions|MarkdownOptionsShape,
 *   numResults?: int|null,
 *   policies?: list<string>|null,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebSearchParams implements BaseModel
{
    /** @use SdkModel<WebSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query. Accepts natural language and search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     */
    #[Required]
    public string $query;

    /**
     * Localize results to this country, as an ISO 3166-1 alpha-2 code such as `us` or `de`.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Maximum length of each result's `description`, in characters.
     */
    #[Optional(nullable: true)]
    public ?int $descriptionMaxCharacters;

    /**
     * Leave out results from these domains, such as `pinterest.com`.
     *
     * @var list<string>|null $excludeDomains
     */
    #[Optional(list: 'string')]
    public ?array $excludeDomains;

    /**
     * Restrict results to content published within this window.
     *
     * @var value-of<Freshness>|null $freshness
     */
    #[Optional(enum: Freshness::class)]
    public ?string $freshness;

    /**
     * Return passages from each result page that are relevant to the query. Pages are read with the `markdownOptions` settings.
     */
    #[Optional(nullable: true)]
    public ?HighlightsOptions $highlightsOptions;

    /**
     * Only return results from these domains, such as `arxiv.org`.
     *
     * @var list<string>|null $includeDomains
     */
    #[Optional(list: 'string')]
    public ?array $includeDomains;

    /**
     * Languages to return results in, as BCP 47 codes such as `en` or `de`, or `all` for any language.
     *
     * @var LanguagesVariants|null $languages
     */
    #[Optional(union: Languages::class)]
    public array|string|null $languages;

    /**
     * Scrape each result page to Markdown. Set `enabled` to `true` to turn it on.
     */
    #[Optional(nullable: true)]
    public ?MarkdownOptions $markdownOptions;

    /**
     * Number of results to return.
     */
    #[Optional]
    public ?int $numResults;

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Request deadline and what to return when it passes.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebSearchParams)->withQuery(...)
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
     * @param list<string>|null $excludeDomains
     * @param Freshness|value-of<Freshness>|null $freshness
     * @param HighlightsOptions|HighlightsOptionsShape|null $highlightsOptions
     * @param list<string>|null $includeDomains
     * @param LanguagesShape|null $languages
     * @param MarkdownOptions|MarkdownOptionsShape|null $markdownOptions
     * @param list<string>|null $policies
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $query,
        Country|string|null $country = null,
        ?int $descriptionMaxCharacters = null,
        ?array $excludeDomains = null,
        Freshness|string|null $freshness = null,
        HighlightsOptions|array|null $highlightsOptions = null,
        ?array $includeDomains = null,
        UnionMember0|array|string|null $languages = null,
        MarkdownOptions|array|null $markdownOptions = null,
        ?int $numResults = null,
        ?array $policies = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $country && $self['country'] = $country;
        null !== $descriptionMaxCharacters && $self['descriptionMaxCharacters'] = $descriptionMaxCharacters;
        null !== $excludeDomains && $self['excludeDomains'] = $excludeDomains;
        null !== $freshness && $self['freshness'] = $freshness;
        null !== $highlightsOptions && $self['highlightsOptions'] = $highlightsOptions;
        null !== $includeDomains && $self['includeDomains'] = $includeDomains;
        null !== $languages && $self['languages'] = $languages;
        null !== $markdownOptions && $self['markdownOptions'] = $markdownOptions;
        null !== $numResults && $self['numResults'] = $numResults;
        null !== $policies && $self['policies'] = $policies;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Search query. Accepts natural language and search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Localize results to this country, as an ISO 3166-1 alpha-2 code such as `us` or `de`.
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
     * Maximum length of each result's `description`, in characters.
     */
    public function withDescriptionMaxCharacters(
        ?int $descriptionMaxCharacters
    ): self {
        $self = clone $this;
        $self['descriptionMaxCharacters'] = $descriptionMaxCharacters;

        return $self;
    }

    /**
     * Leave out results from these domains, such as `pinterest.com`.
     *
     * @param list<string> $excludeDomains
     */
    public function withExcludeDomains(array $excludeDomains): self
    {
        $self = clone $this;
        $self['excludeDomains'] = $excludeDomains;

        return $self;
    }

    /**
     * Restrict results to content published within this window.
     *
     * @param Freshness|value-of<Freshness> $freshness
     */
    public function withFreshness(Freshness|string $freshness): self
    {
        $self = clone $this;
        $self['freshness'] = $freshness;

        return $self;
    }

    /**
     * Return passages from each result page that are relevant to the query. Pages are read with the `markdownOptions` settings.
     *
     * @param HighlightsOptions|HighlightsOptionsShape|null $highlightsOptions
     */
    public function withHighlightsOptions(
        HighlightsOptions|array|null $highlightsOptions
    ): self {
        $self = clone $this;
        $self['highlightsOptions'] = $highlightsOptions;

        return $self;
    }

    /**
     * Only return results from these domains, such as `arxiv.org`.
     *
     * @param list<string> $includeDomains
     */
    public function withIncludeDomains(array $includeDomains): self
    {
        $self = clone $this;
        $self['includeDomains'] = $includeDomains;

        return $self;
    }

    /**
     * Languages to return results in, as BCP 47 codes such as `en` or `de`, or `all` for any language.
     *
     * @param LanguagesShape $languages
     */
    public function withLanguages(UnionMember0|array|string $languages): self
    {
        $self = clone $this;
        $self['languages'] = $languages;

        return $self;
    }

    /**
     * Scrape each result page to Markdown. Set `enabled` to `true` to turn it on.
     *
     * @param MarkdownOptions|MarkdownOptionsShape|null $markdownOptions
     */
    public function withMarkdownOptions(
        MarkdownOptions|array|null $markdownOptions
    ): self {
        $self = clone $this;
        $self['markdownOptions'] = $markdownOptions;

        return $self;
    }

    /**
     * Number of results to return.
     */
    public function withNumResults(int $numResults): self
    {
        $self = clone $this;
        $self['numResults'] = $numResults;

        return $self;
    }

    /**
     * Access policy IDs to apply; each URL must pass all of them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * Request deadline and what to return when it passes.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
