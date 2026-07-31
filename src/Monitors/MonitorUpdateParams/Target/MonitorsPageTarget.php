<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateParams\Target;

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
     */
    public static function with(
        string $url,
        ?string $instructions = null,
        ?bool $normalizeWhitespace = null
    ): self {
        $self = new self;

        $self['url'] = $url;

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
