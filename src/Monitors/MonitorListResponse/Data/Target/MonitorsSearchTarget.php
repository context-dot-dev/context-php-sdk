<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Search the web on every run and report results not seen before, listed in the change's `matched_urls` and `evidence`. `semantic` detection reports only results about a new development that matches `instructions`; `exact` detection reports every new result.
 *
 * @phpstan-type MonitorsSearchTargetShape = array{
 *   query: string, type: 'search', instructions?: string|null
 * }
 */
final class MonitorsSearchTarget implements BaseModel
{
    /** @use SdkModel<MonitorsSearchTargetShape> */
    use SdkModel;

    /**
     * Use `search` to watch the web for new results about a topic.
     *
     * @var 'search' $type
     */
    #[Required]
    public string $type = 'search';

    /**
     * Web search query to run on every check. Supports `site:`, `-site:`, and quoted phrases.
     */
    #[Required]
    public string $query;

    /**
     * Plain-language description of the new results that matter. Defaults to `query`. Not allowed with `exact` detection.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * `new MonitorsSearchTarget()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSearchTarget::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsSearchTarget)->withQuery(...)
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
     */
    public static function with(
        string $query,
        ?string $instructions = null
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Web search query to run on every check. Supports `site:`, `-site:`, and quoted phrases.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Use `search` to watch the web for new results about a topic.
     *
     * @param 'search' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Plain-language description of the new results that matter. Defaults to `query`. Not allowed with `exact` detection.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
