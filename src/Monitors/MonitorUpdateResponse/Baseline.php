<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorUpdateResponse\Baseline\MonitorsExtractBaseline;
use ContextDev\Monitors\MonitorUpdateResponse\Baseline\MonitorsPageBaseline;
use ContextDev\Monitors\MonitorUpdateResponse\Baseline\MonitorsSitemapBaseline;

/**
 * Current baseline: the last observed value the monitor compares new snapshots against. Its shape follows `target.type` (page/sitemap/extract). Only populated on GET /monitors/{monitor_id}; null until the first baseline run completes (and after a target or change_detection update, which resets the baseline).
 *
 * @phpstan-import-type MonitorsPageBaselineShape from \ContextDev\Monitors\MonitorUpdateResponse\Baseline\MonitorsPageBaseline
 * @phpstan-import-type MonitorsSitemapBaselineShape from \ContextDev\Monitors\MonitorUpdateResponse\Baseline\MonitorsSitemapBaseline
 * @phpstan-import-type MonitorsExtractBaselineShape from \ContextDev\Monitors\MonitorUpdateResponse\Baseline\MonitorsExtractBaseline
 *
 * @phpstan-type BaselineVariants = MonitorsPageBaseline|MonitorsSitemapBaseline|MonitorsExtractBaseline
 * @phpstan-type BaselineShape = BaselineVariants|MonitorsPageBaselineShape|MonitorsSitemapBaselineShape|MonitorsExtractBaselineShape
 */
final class Baseline implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            MonitorsPageBaseline::class,
            MonitorsSitemapBaseline::class,
            MonitorsExtractBaseline::class,
        ];
    }
}
