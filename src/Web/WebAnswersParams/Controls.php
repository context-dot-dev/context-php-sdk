<?php

declare(strict_types=1);

namespace ContextDev\Web\WebAnswersParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Limits what the research may use.
 *
 * @phpstan-type ControlsShape = array{
 *   excludeSources?: list<string>|null, sources?: list<string>|null
 * }
 */
final class Controls implements BaseModel
{
    /** @use SdkModel<ControlsShape> */
    use SdkModel;

    /**
     * Never search, read or cite these sites, sections or pages. Same format as `sources`. Up to 100 entries.
     *
     * @var list<string>|null $excludeSources
     */
    #[Optional(list: 'string')]
    public ?array $excludeSources;

    /**
     * Only search, read and cite these sites, sections or pages. Each entry is a URL prefix: "example.com" covers the site and its subdomains, "example.com/docs" covers that section, and "example.com/docs/setup.html" is one page. Up to 20 entries.
     *
     * @var list<string>|null $sources
     */
    #[Optional(list: 'string')]
    public ?array $sources;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $excludeSources
     * @param list<string>|null $sources
     */
    public static function with(
        ?array $excludeSources = null,
        ?array $sources = null
    ): self {
        $self = new self;

        null !== $excludeSources && $self['excludeSources'] = $excludeSources;
        null !== $sources && $self['sources'] = $sources;

        return $self;
    }

    /**
     * Never search, read or cite these sites, sections or pages. Same format as `sources`. Up to 100 entries.
     *
     * @param list<string> $excludeSources
     */
    public function withExcludeSources(array $excludeSources): self
    {
        $self = clone $this;
        $self['excludeSources'] = $excludeSources;

        return $self;
    }

    /**
     * Only search, read and cite these sites, sections or pages. Each entry is a URL prefix: "example.com" covers the site and its subdomains, "example.com/docs" covers that section, and "example.com/docs/setup.html" is one page. Up to 20 entries.
     *
     * @param list<string> $sources
     */
    public function withSources(array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }
}
