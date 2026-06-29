<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsSitemapExactMonitor;

/**
 * Union of monitor response shapes.
 *
 * @phpstan-import-type MonitorsPageExactMonitorShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageExactMonitor
 * @phpstan-import-type MonitorsSitemapExactMonitorShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsSitemapExactMonitor
 * @phpstan-import-type MonitorsPageSemanticMonitorShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor
 * @phpstan-import-type MonitorsExtractSemanticMonitorShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsExtractSemanticMonitor
 *
 * @phpstan-type DataVariants = MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor
 * @phpstan-type DataShape = DataVariants|MonitorsPageExactMonitorShape|MonitorsSitemapExactMonitorShape|MonitorsPageSemanticMonitorShape|MonitorsExtractSemanticMonitorShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            MonitorsPageExactMonitor::class,
            MonitorsSitemapExactMonitor::class,
            MonitorsPageSemanticMonitor::class,
            MonitorsExtractSemanticMonitor::class,
        ];
    }
}
