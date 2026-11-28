<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorCreateParams\ChangeDetection;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Report every change: visible-text diffs for pages, added or removed URLs for sitemaps, and every new result for searches.
 *
 * @phpstan-type MonitorsExactChangeDetectionShape = array{type: 'exact'}
 */
final class MonitorsExactChangeDetection implements BaseModel
{
    /** @use SdkModel<MonitorsExactChangeDetectionShape> */
    use SdkModel;

    /**
     * Use `exact` to compare visible text, sitemap URLs, or search results.
     *
     * @var 'exact' $type
     */
    #[Required]
    public string $type = 'exact';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * Use `exact` to compare visible text, sitemap URLs, or search results.
     *
     * @param 'exact' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
