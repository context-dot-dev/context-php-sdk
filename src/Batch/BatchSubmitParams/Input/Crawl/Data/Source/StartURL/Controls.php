<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages\UnionMember0;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for page discovery.
 *
 * @phpstan-import-type LanguagesVariants from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages
 * @phpstan-import-type LanguagesShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\StartURL\Controls\Languages
 *
 * @phpstan-type ControlsShape = array{
 *   excludeRegex?: string|null,
 *   followSubdomains?: bool|null,
 *   languages?: LanguagesShape|null,
 *   maxDepth?: int|null,
 *   maxURLs?: int|null,
 *   regex?: string|null,
 * }
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

    /**
     * Regex pattern for URLs to exclude, even when they match `regex`. The `start_url` itself is always included.
     */
    #[Optional]
    public ?string $excludeRegex;

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
     * Regex pattern for URLs to include. The `start_url` itself is always included.
     */
    #[Optional]
    public ?string $regex;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param LanguagesShape|null $languages
     */
    public static function with(
        ?string $excludeRegex = null,
        ?bool $followSubdomains = null,
        UnionMember0|array|string|null $languages = null,
        ?int $maxDepth = null,
        ?int $maxURLs = null,
        ?string $regex = null,
    ): self {
        $self = new self;

        null !== $excludeRegex && $self['excludeRegex'] = $excludeRegex;
        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $languages && $self['languages'] = $languages;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $regex && $self['regex'] = $regex;

        return $self;
    }

    /**
     * Regex pattern for URLs to exclude, even when they match `regex`. The `start_url` itself is always included.
     */
    public function withExcludeRegex(string $excludeRegex): self
    {
        $self = clone $this;
        $self['excludeRegex'] = $excludeRegex;

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
     * Regex pattern for URLs to include. The `start_url` itself is always included.
     */
    public function withRegex(string $regex): self
    {
        $self = clone $this;
        $self['regex'] = $regex;

        return $self;
    }
}
