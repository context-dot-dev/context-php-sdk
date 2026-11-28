<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action;

/**
 * Watch one web page. `exact` detection reports any change to the visible text; `semantic` detection reports only confirmed changes that match `instructions`.
 *
 * @phpstan-import-type ActionVariants from \ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action
 * @phpstan-import-type ActionShape from \ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action
 *
 * @phpstan-type MonitorsPageTargetShape = array{
 *   type: 'page',
 *   url: string,
 *   actions?: list<ActionShape>|null,
 *   excludeSelectors?: list<string>|null,
 *   includeSelectors?: list<string>|null,
 *   instructions?: string|null,
 *   normalizeWhitespace?: bool|null,
 * }
 */
final class MonitorsPageTarget implements BaseModel
{
    /** @use SdkModel<MonitorsPageTargetShape> */
    use SdkModel;

    /**
     * Use `page` to watch one web page.
     *
     * @var 'page' $type
     */
    #[Required]
    public string $type = 'page';

    /**
     * Public HTTP(S) URL of the page to watch.
     */
    #[Required]
    public string $url;

    /**
     * Browser actions to run in order after the page loads and before each capture. Requires a paid plan. Changing it resets the baseline.
     *
     * @var list<ActionVariants>|null $actions
     */
    #[Optional(list: Action::class, nullable: true)]
    public ?array $actions;

    /**
     * CSS selectors for regions to ignore, applied after `include_selectors`. Changing it resets the baseline.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional('exclude_selectors', list: 'string')]
    public ?array $excludeSelectors;

    /**
     * CSS selectors for the regions to watch. Omit or leave empty to watch the main content. Changing it resets the baseline.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional('include_selectors', list: 'string')]
    public ?array $includeSelectors;

    /**
     * Plain-language description of the changes that matter. Requires `semantic` detection, which is selected when `change_detection` is omitted.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * Collapse whitespace before comparing text, so spacing-only edits are not reported.
     */
    #[Optional('normalize_whitespace')]
    public ?bool $normalizeWhitespace;

    /**
     * `new MonitorsPageTarget()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsPageTarget::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsPageTarget)->withURL(...)
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
     * @param list<ActionShape>|null $actions
     * @param list<string>|null $excludeSelectors
     * @param list<string>|null $includeSelectors
     */
    public static function with(
        string $url,
        ?array $actions = null,
        ?array $excludeSelectors = null,
        ?array $includeSelectors = null,
        ?string $instructions = null,
        ?bool $normalizeWhitespace = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $actions && $self['actions'] = $actions;
        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $normalizeWhitespace && $self['normalizeWhitespace'] = $normalizeWhitespace;

        return $self;
    }

    /**
     * Use `page` to watch one web page.
     *
     * @param 'page' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Public HTTP(S) URL of the page to watch.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Browser actions to run in order after the page loads and before each capture. Requires a paid plan. Changing it resets the baseline.
     *
     * @param list<ActionShape>|null $actions
     */
    public function withActions(?array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * CSS selectors for regions to ignore, applied after `include_selectors`. Changing it resets the baseline.
     *
     * @param list<string> $excludeSelectors
     */
    public function withExcludeSelectors(array $excludeSelectors): self
    {
        $self = clone $this;
        $self['excludeSelectors'] = $excludeSelectors;

        return $self;
    }

    /**
     * CSS selectors for the regions to watch. Omit or leave empty to watch the main content. Changing it resets the baseline.
     *
     * @param list<string> $includeSelectors
     */
    public function withIncludeSelectors(array $includeSelectors): self
    {
        $self = clone $this;
        $self['includeSelectors'] = $includeSelectors;

        return $self;
    }

    /**
     * Plain-language description of the changes that matter. Requires `semantic` detection, which is selected when `change_detection` is omitted.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Collapse whitespace before comparing text, so spacing-only edits are not reported.
     */
    public function withNormalizeWhitespace(bool $normalizeWhitespace): self
    {
        $self = clone $this;
        $self['normalizeWhitespace'] = $normalizeWhitespace;

        return $self;
    }
}
