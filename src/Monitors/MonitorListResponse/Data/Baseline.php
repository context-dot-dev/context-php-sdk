<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsExtractBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsPageBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSearchBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSitemapBaseline;

/**
 * What the next run compares against. Returned only by `GET /monitors/{monitor_id}`; `null` until the first capture finishes or after the target changes.
 *
 * @phpstan-import-type MonitorsPageBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsPageBaseline
 * @phpstan-import-type MonitorsSitemapBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSitemapBaseline
 * @phpstan-import-type MonitorsExtractBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsExtractBaseline
 * @phpstan-import-type MonitorsSearchBaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSearchBaseline
 *
 * @phpstan-type BaselineVariants = MonitorsPageBaseline|MonitorsSitemapBaseline|MonitorsExtractBaseline|MonitorsSearchBaseline
 * @phpstan-type BaselineShape = BaselineVariants|MonitorsPageBaselineShape|MonitorsSitemapBaselineShape|MonitorsExtractBaselineShape|MonitorsSearchBaselineShape
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
            MonitorsSearchBaseline::class,
        ];
    }
}
