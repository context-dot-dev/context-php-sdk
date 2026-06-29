<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorNewResponse\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorNewResponse\MonitorsSitemapExactMonitor;

/**
 * Union of monitor response shapes.
 *
 * @phpstan-import-type MonitorsPageExactMonitorShape from \ContextDev\Monitors\MonitorNewResponse\MonitorsPageExactMonitor
 * @phpstan-import-type MonitorsSitemapExactMonitorShape from \ContextDev\Monitors\MonitorNewResponse\MonitorsSitemapExactMonitor
 * @phpstan-import-type MonitorsPageSemanticMonitorShape from \ContextDev\Monitors\MonitorNewResponse\MonitorsPageSemanticMonitor
 * @phpstan-import-type MonitorsExtractSemanticMonitorShape from \ContextDev\Monitors\MonitorNewResponse\MonitorsExtractSemanticMonitor
 *
 * @phpstan-type MonitorNewResponseVariants = MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor
 * @phpstan-type MonitorNewResponseShape = MonitorNewResponseVariants|MonitorsPageExactMonitorShape|MonitorsSitemapExactMonitorShape|MonitorsPageSemanticMonitorShape|MonitorsExtractSemanticMonitorShape
 */
final class MonitorNewResponse implements ConverterSource
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
