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
use ContextDev\Web\WebSearchParams\MarkdownOptions;

/**
 * Search the web and optionally scrape each result to Markdown in one round-trip.
 *
 * @see ContextDev\Services\WebService::search()
 *
 * @phpstan-import-type MarkdownOptionsShape from \ContextDev\Web\WebSearchParams\MarkdownOptions
 *
 * @phpstan-type WebSearchParamsShape = array{
 *   query: string,
 *   country?: null|Country|value-of<Country>,
 *   excludeDomains?: list<string>|null,
 *   freshness?: null|Freshness|value-of<Freshness>,
 *   includeDomains?: list<string>|null,
 *   markdownOptions?: null|MarkdownOptions|MarkdownOptionsShape,
 *   numResults?: int|null,
 *   queryFanout?: bool|null,
 *   timeoutMs?: int|null,
 * }
 */
final class WebSearchParams implements BaseModel
{
    /** @use SdkModel<WebSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query. Accepts natural language as well as Google-style search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     */
    #[Required]
    public string $query;

    /**
     * Two-letter ISO 3166-1 alpha-2 country code to localize results to a specific country (maps to Google's `gl` parameter). Example: "us", "gb", "de".
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Blocklist — drop results from these domains. Example: ["pinterest.com", "reddit.com"].
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
     * Allowlist — only return results from these domains. Example: ["arxiv.org", "github.com"].
     *
     * @var list<string>|null $includeDomains
     */
    #[Optional(list: 'string')]
    public ?array $includeDomains;

    /**
     * Inline Markdown scraping for each result. Set `enabled: true` to activate.
     */
    #[Optional]
    public ?MarkdownOptions $markdownOptions;

    /**
     * Number of results to request and return (10–100). Defaults to 10.
     */
    #[Optional]
    public ?int $numResults;

    /**
     * Expand the query into multiple parallel variants for broader recall.
     */
    #[Optional]
    public ?bool $queryFanout;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

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
     * @param list<string>|null $includeDomains
     * @param MarkdownOptions|MarkdownOptionsShape|null $markdownOptions
     */
    public static function with(
        string $query,
        Country|string|null $country = null,
        ?array $excludeDomains = null,
        Freshness|string|null $freshness = null,
        ?array $includeDomains = null,
        MarkdownOptions|array|null $markdownOptions = null,
        ?int $numResults = null,
        ?bool $queryFanout = null,
        ?int $timeoutMs = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $country && $self['country'] = $country;
        null !== $excludeDomains && $self['excludeDomains'] = $excludeDomains;
        null !== $freshness && $self['freshness'] = $freshness;
        null !== $includeDomains && $self['includeDomains'] = $includeDomains;
        null !== $markdownOptions && $self['markdownOptions'] = $markdownOptions;
        null !== $numResults && $self['numResults'] = $numResults;
        null !== $queryFanout && $self['queryFanout'] = $queryFanout;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Search query. Accepts natural language as well as Google-style search operators such as `site:`, `-site:`, `inurl:`, `intitle:`, quoted phrases, and `OR`.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Two-letter ISO 3166-1 alpha-2 country code to localize results to a specific country (maps to Google's `gl` parameter). Example: "us", "gb", "de".
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
     * Blocklist — drop results from these domains. Example: ["pinterest.com", "reddit.com"].
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
     * Allowlist — only return results from these domains. Example: ["arxiv.org", "github.com"].
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
     * Inline Markdown scraping for each result. Set `enabled: true` to activate.
     *
     * @param MarkdownOptions|MarkdownOptionsShape $markdownOptions
     */
    public function withMarkdownOptions(
        MarkdownOptions|array $markdownOptions
    ): self {
        $self = clone $this;
        $self['markdownOptions'] = $markdownOptions;

        return $self;
    }

    /**
     * Number of results to request and return (10–100). Defaults to 10.
     */
    public function withNumResults(int $numResults): self
    {
        $self = clone $this;
        $self['numResults'] = $numResults;

        return $self;
    }

    /**
     * Expand the query into multiple parallel variants for broader recall.
     */
    public function withQueryFanout(bool $queryFanout): self
    {
        $self = clone $this;
        $self['queryFanout'] = $queryFanout;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }
}
