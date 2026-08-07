<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\StartURL;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits and filters for page discovery.
 *
 * @phpstan-type ControlsShape = array{
 *   followSubdomains?: bool|null,
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
     * Follow links to subdomains.
     */
    #[Optional]
    public ?bool $followSubdomains;

    /**
     * Maximum link depth. Source pages are depth 0. No limit when omitted.
     */
    #[Optional]
    public ?int $maxDepth;

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 25000.
     */
    #[Optional('maxUrls')]
    public ?int $maxURLs;

    /**
     * RE2 pattern for URLs to include. The `start_url` itself is always included.
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
     */
    public static function with(
        ?bool $followSubdomains = null,
        ?int $maxDepth = null,
        ?int $maxURLs = null,
        ?string $regex = null,
    ): self {
        $self = new self;

        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxURLs && $self['maxURLs'] = $maxURLs;
        null !== $regex && $self['regex'] = $regex;

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
     * Maximum link depth. Source pages are depth 0. No limit when omitted.
     */
    public function withMaxDepth(int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * Maximum pages to fetch. Unused reserved credits are refunded. Maximum 25000.
     */
    public function withMaxURLs(int $maxURLs): self
    {
        $self = clone $this;
        $self['maxURLs'] = $maxURLs;

        return $self;
    }

    /**
     * RE2 pattern for URLs to include. The `start_url` itself is always included.
     */
    public function withRegex(string $regex): self
    {
        $self = clone $this;
        $self['regex'] = $regex;

        return $self;
    }
}
