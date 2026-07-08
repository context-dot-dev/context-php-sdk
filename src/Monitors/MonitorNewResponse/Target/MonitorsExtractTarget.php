<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorNewResponse\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Watch the monitor-relevant pages of a site for meaningful changes. A crawl guided by `schema`/`instructions` selects up to `max_pages` relevant pages to track; each run re-checks exactly those pages, and confirmed content changes are judged against the monitor's instructions. The tracked page set is refreshed by a periodic re-discovery crawl.
 *
 * @phpstan-type MonitorsExtractTargetShape = array{
 *   instructions: string,
 *   type: 'extract',
 *   url: string,
 *   followSubdomains?: bool|null,
 *   maxDepth?: int|null,
 *   maxPages?: int|null,
 *   schema?: array<string,mixed>|null,
 * }
 */
final class MonitorsExtractTarget implements BaseModel
{
    /** @use SdkModel<MonitorsExtractTargetShape> */
    use SdkModel;

    /** @var 'extract' $type */
    #[Required]
    public string $type = 'extract';

    /**
     * Natural-language instructions guiding which pages and facts to track and which changes to report.
     */
    #[Required]
    public string $instructions;

    /**
     * Root URL to extract structured data from.
     */
    #[Required]
    public string $url;

    #[Optional('follow_subdomains')]
    public ?bool $followSubdomains;

    /**
     * Optional maximum link depth from the starting URL (0 = only the starting page).
     */
    #[Optional('max_depth')]
    public ?int $maxDepth;

    /**
     * Maximum number of pages to track.
     */
    #[Optional('max_pages')]
    public ?int $maxPages;

    /**
     * JSON Schema describing the data you care about. It guides which pages are selected for tracking and gives the change judge context on what matters. If omitted, a default summary + key-points schema is used.
     *
     * @var array<string,mixed>|null $schema
     */
    #[Optional(map: 'mixed')]
    public ?array $schema;

    /**
     * `new MonitorsExtractTarget()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsExtractTarget::with(instructions: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsExtractTarget)->withInstructions(...)->withURL(...)
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
     * @param array<string,mixed>|null $schema
     */
    public static function with(
        string $instructions,
        string $url,
        ?bool $followSubdomains = null,
        ?int $maxDepth = null,
        ?int $maxPages = null,
        ?array $schema = null,
    ): self {
        $self = new self;

        $self['instructions'] = $instructions;
        $self['url'] = $url;

        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxPages && $self['maxPages'] = $maxPages;
        null !== $schema && $self['schema'] = $schema;

        return $self;
    }

    /**
     * Natural-language instructions guiding which pages and facts to track and which changes to report.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param 'extract' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Root URL to extract structured data from.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Optional maximum link depth from the starting URL (0 = only the starting page).
     */
    public function withMaxDepth(int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * Maximum number of pages to track.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * JSON Schema describing the data you care about. It guides which pages are selected for tracking and gives the change judge context on what matters. If omitted, a default summary + key-points schema is used.
     *
     * @param array<string,mixed> $schema
     */
    public function withSchema(array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }
}
