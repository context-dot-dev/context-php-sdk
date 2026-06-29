<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse\MonitorsSitemapExactMonitor;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorUpdateResponse\MonitorsSitemapExactMonitor\ChangeDetection\Type;

/**
 * Detect exact changes. For page targets, this means visible text diffs. For sitemap targets, this means URL additions and removals.
 *
 * @phpstan-type ChangeDetectionShape = array{type: Type|value-of<Type>}
 */
final class ChangeDetection implements BaseModel
{
    /** @use SdkModel<ChangeDetectionShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ChangeDetection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChangeDetection::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChangeDetection)->withType(...)
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
     */
    public static function with(Type|string $type): self
    {
        $self = new self;

        $self['type'] = $type;

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
}
