<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\Target;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Watch a single web page. Exact detection reports visible-text diffs; semantic detection judges confirmed stable diffs against `instructions`.
 *
 * @phpstan-type MonitorsPageTargetShape = array{
 *   type: 'page',
 *   url: string,
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

    /** @var 'page' $type */
    #[Required]
    public string $type = 'page';

    #[Required]
    public string $url;

    /**
     * CSS selectors for HTML regions to remove before text extraction. Applied after include_selectors; exclusion takes precedence when an element matches both. Omit or pass an empty array to apply no explicit exclusions. Changing these selectors creates a new baseline.
     *
     * @var list<string>|null $excludeSelectors
     */
    #[Optional('exclude_selectors', list: 'string')]
    public ?array $excludeSelectors;

    /**
     * CSS selectors defining the HTML regions to monitor. Matching subtrees are combined in document order before text extraction, instead of automatic main-content selection. Omit or pass an empty array to use automatic main-content extraction. If the filtered page has no usable text, the run fails without replacing the baseline. Changing these selectors creates a new baseline.
     *
     * @var list<string>|null $includeSelectors
     */
    #[Optional('include_selectors', list: 'string')]
    public ?array $includeSelectors;

    /**
     * Plain-language goal describing which page changes matter. When provided without change_detection, semantic detection is inferred.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * Normalize whitespace before comparing or analyzing text.
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
     * @param list<string>|null $excludeSelectors
     * @param list<string>|null $includeSelectors
     */
    public static function with(
        string $url,
        ?array $excludeSelectors = null,
        ?array $includeSelectors = null,
        ?string $instructions = null,
        ?bool $normalizeWhitespace = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $excludeSelectors && $self['excludeSelectors'] = $excludeSelectors;
        null !== $includeSelectors && $self['includeSelectors'] = $includeSelectors;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $normalizeWhitespace && $self['normalizeWhitespace'] = $normalizeWhitespace;

        return $self;
    }

    /**
     * @param 'page' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * CSS selectors for HTML regions to remove before text extraction. Applied after include_selectors; exclusion takes precedence when an element matches both. Omit or pass an empty array to apply no explicit exclusions. Changing these selectors creates a new baseline.
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
     * CSS selectors defining the HTML regions to monitor. Matching subtrees are combined in document order before text extraction, instead of automatic main-content selection. Omit or pass an empty array to use automatic main-content extraction. If the filtered page has no usable text, the run fails without replacing the baseline. Changing these selectors creates a new baseline.
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
     * Plain-language goal describing which page changes matter. When provided without change_detection, semantic detection is inferred.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Normalize whitespace before comparing or analyzing text.
     */
    public function withNormalizeWhitespace(bool $normalizeWhitespace): self
    {
        $self = clone $this;
        $self['normalizeWhitespace'] = $normalizeWhitespace;

        return $self;
    }
}
