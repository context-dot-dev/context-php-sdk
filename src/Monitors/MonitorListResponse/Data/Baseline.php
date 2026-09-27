<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsExtractBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsPageBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSitemapBaseline;

/**
 * Comparison baseline, included on Retrieve. Null until capture completes or after target changes.
 *
 * @phpstan-import-type MonitorsPageBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsPageBaseline
 * @phpstan-import-type MonitorsSitemapBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSitemapBaseline
 * @phpstan-import-type MonitorsExtractBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsExtractBaseline
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
