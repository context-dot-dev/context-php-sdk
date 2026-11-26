<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Exclude;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Follow;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages\UnionMember0;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Scrape;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for page discovery.
 *
 * @phpstan-import-type ExcludeVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Exclude
 * @phpstan-import-type FollowVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Follow
 * @phpstan-import-type LanguagesVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages
 * @phpstan-import-type ScrapeVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Scrape
 * @phpstan-import-type ExcludeShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Exclude
 * @phpstan-import-type FollowShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Follow
 * @phpstan-import-type LanguagesShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages
 * @phpstan-import-type ScrapeShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Scrape
 *
 * @phpstan-type ControlsShape = array{
 *   exclude?: list<ExcludeShape>|null,
 *   follow?: list<FollowShape>|null,
 *   followSubdomains?: bool|null,
 *   languages?: LanguagesShape|null,
 *   maxDepth?: int|null,
 *   maxURLs?: int|null,
 *   scrape?: list<ScrapeShape>|null,
 * }
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

    /**
     * Pages to skip entirely, even when they match `follow` or `scrape`.
     *
     * @var list<ExcludeVariants>|null $exclude
     */
    #[Optional(list: Exclude::class)]
    public ?array $exclude;

    /**
     * Links to follow from each page; every followed page is checked for links again. Follows all links when omitted.
     *
     * @var list<FollowVariants>|null $follow
     */
    #[Optional(list: Follow::class)]
    public ?array $follow;

    /**
     * Follow links to subdomains.
     */
    #[Optional]
    public ?bool $followSubdomains;

    /**
     * Only follow pages in these languages, or `same_as_start_url`; all languages when omitted.
     *
     * @var LanguagesVariants|null $languages
     */
    #[Optional(union: Languages::class)]
    public array|string|null $languages;

    /**
     * Maximum link depth. Source pages are depth 0. No limit when omitted.
     */
    #[Optional]
    public ?int $maxDepth;

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 100000.
     */
    #[Optional('maxUrls')]
    public ?int $maxURLs;

    /**
     * Pages to return in the results. Returns every fetched page when omitted.
     *
     * @var list<ScrapeVariants>|null $scrape
     */
    #[Optional(list: Scrape::class)]
    public ?array $scrape;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<ExcludeShape>|null $exclude
     * @param list<FollowShape>|null $follow
     * @param LanguagesShape|null $languages
     * @param list<ScrapeShape>|null $scrape
     */
    public static function with(
        ?array $exclude = null,
        ?array $follow = null,
        ?bool $followSubdomains = null,
        UnionMember0|array|string|null $languages = null,
        ?int $maxDepth = null,
        ?int $maxURLs = null,
        ?array $scrape = null,
    ): self {
        $self = new self;

        null !== $exclude && $self['exclude'] = $exclude;
        null !== $follow && $self['follow'] = $follow;
        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $languages && $self['languages'] = $languages;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $scrape && $self['scrape'] = $scrape;

        return $self;
    }

    /**
     * Pages to skip entirely, even when they match `follow` or `scrape`.
     *
     * @param list<ExcludeShape> $exclude
     */
    public function withExclude(array $exclude): self
    {
        $self = clone $this;
        $self['exclude'] = $exclude;

        return $self;
    }

    /**
     * Links to follow from each page; every followed page is checked for links again. Follows all links when omitted.
     *
     * @param list<FollowShape> $follow
     */
    public function withFollow(array $follow): self
    {
        $self = clone $this;
        $self['follow'] = $follow;

        return $self;
    }

    /**
     * Follow links to subdomains.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Only follow pages in these languages, or `same_as_start_url`; all languages when omitted.
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
     * Maximum link depth. Source pages are depth 0. No limit when omitted.
     */
    public function withMaxDepth(int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 100000.
     */
    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }

    /**
     * Pages to return in the results. Returns every fetched page when omitted.
     *
     * @param list<ScrapeShape> $scrape
     */
    public function withScrape(array $scrape): self
    {
        $self = clone $this;
        $self['scrape'] = $scrape;

        return $self;
    }
}
