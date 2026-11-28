<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateParams\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Extract structured data from the most relevant pages of a site and report meaningful changes. Pages are chosen from `schema` and `instructions`, and the page set is refreshed periodically.
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

    /**
     * Use `extract` to watch structured data across selected pages.
     *
     * @var 'extract' $type
     */
    #[Required]
    public string $type = 'extract';

    /**
     * Plain-language description of the pages and facts to track and the changes to report.
     */
    #[Required]
    public string $instructions;

    /**
     * Public HTTP(S) URL where page discovery starts, usually the site home page.
     */
    #[Required]
    public string $url;

    /**
     * Also discover pages on subdomains of the site.
     */
    #[Optional('follow_subdomains')]
    public ?bool $followSubdomains;

    /**
     * Maximum link depth from `url`. `0` tracks only the starting page.
     */
    #[Optional('max_depth')]
    public ?int $maxDepth;

    /**
     * Maximum number of pages to track.
     */
    #[Optional('max_pages')]
    public ?int $maxPages;

    /**
     * JSON Schema for the data to extract, up to 20,000 characters; it also guides which pages are tracked. Defaults to a `summary` string and a `key_points` list.
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
     * Plain-language description of the pages and facts to track and the changes to report.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Use `extract` to watch structured data across selected pages.
     *
     * @param 'extract' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Public HTTP(S) URL where page discovery starts, usually the site home page.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Also discover pages on subdomains of the site.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * Maximum link depth from `url`. `0` tracks only the starting page.
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
     * JSON Schema for the data to extract, up to 20,000 characters; it also guides which pages are tracked. Defaults to a `summary` string and a `key_points` list.
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
