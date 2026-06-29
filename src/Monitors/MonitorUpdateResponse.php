<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorUpdateResponse\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorUpdateResponse\MonitorsSitemapExactMonitor;

/**
 * Union of monitor response shapes.
 *
 * @phpstan-import-type MonitorsPageExactMonitorShape from \ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageExactMonitor
 * @phpstan-import-type MonitorsSitemapExactMonitorShape from \ContextDev\Monitors\MonitorUpdateResponse\MonitorsSitemapExactMonitor
 * @phpstan-import-type MonitorsPageSemanticMonitorShape from \ContextDev\Monitors\MonitorUpdateResponse\MonitorsPageSemanticMonitor
 * @phpstan-import-type MonitorsExtractSemanticMonitorShape from \ContextDev\Monitors\MonitorUpdateResponse\MonitorsExtractSemanticMonitor
 *
 * @phpstan-type MonitorUpdateResponseVariants = MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor
 * @phpstan-type MonitorUpdateResponseShape = MonitorUpdateResponseVariants|MonitorsPageExactMonitorShape|MonitorsSitemapExactMonitorShape|MonitorsPageSemanticMonitorShape|MonitorsExtractSemanticMonitorShape
 */
final class MonitorUpdateResponse implements ConverterSource
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
