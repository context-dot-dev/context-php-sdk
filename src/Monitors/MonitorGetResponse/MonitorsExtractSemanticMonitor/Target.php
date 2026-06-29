<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\MonitorsExtractSemanticMonitor;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetResponse\MonitorsExtractSemanticMonitor\Target\Type;

/**
 * @phpstan-type TargetShape = array{
 *   type: Type|value-of<Type>,
 *   url: string,
 *   followSubdomains?: bool|null,
 *   instructions?: string|null,
 *   maxDepth?: int|null,
 *   maxPages?: int|null,
 *   schema?: array<string,mixed>|null,
 * }
 */
final class Target implements BaseModel
{
    /** @use SdkModel<TargetShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Root URL to extract structured data from.
     */
    #[Required]
    public string $url;

    #[Optional('follow_subdomains')]
    public ?bool $followSubdomains;

    /**
     * Optional natural-language instructions guiding what to extract.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * Optional maximum link depth from the starting URL (0 = only the starting page).
     */
    #[Optional('max_depth')]
    public ?int $maxDepth;

    /**
     * Maximum number of pages to analyze during extraction.
     */
    #[Optional('max_pages')]
    public ?int $maxPages;

    /**
     * JSON Schema describing the structured data to extract and watch for changes. If omitted, a default summary + key-points schema is used.
     *
     * @var array<string,mixed>|null $schema
     */
    #[Optional(map: 'mixed')]
    public ?array $schema;

    /**
     * `new Target()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Target::with(type: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Target)->withType(...)->withURL(...)
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
     * @param Type|value-of<Type> $type
     * @param array<string,mixed>|null $schema
     */
    public static function with(
        Type|string $type,
        string $url,
        ?bool $followSubdomains = null,
        ?string $instructions = null,
        ?int $maxDepth = null,
        ?int $maxPages = null,
        ?array $schema = null,
    ): self {
        $self = new self;

        $self['type'] = $type;
        $self['url'] = $url;

        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxPages && $self['maxPages'] = $maxPages;
        null !== $schema && $self['schema'] = $schema;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
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
     * Optional natural-language instructions guiding what to extract.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

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
     * Maximum number of pages to analyze during extraction.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * JSON Schema describing the structured data to extract and watch for changes. If omitted, a default summary + key-points schema is used.
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
