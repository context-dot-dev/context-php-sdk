<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorGetResponse\MonitorsExtractSemanticMonitor;
use ContextDev\Monitors\MonitorGetResponse\MonitorsPageExactMonitor;
use ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor;
use ContextDev\Monitors\MonitorGetResponse\MonitorsSitemapExactMonitor;

/**
 * Union of monitor response shapes.
 *
 * @phpstan-import-type MonitorsPageExactMonitorShape from \ContextDev\Monitors\MonitorGetResponse\MonitorsPageExactMonitor
 * @phpstan-import-type MonitorsSitemapExactMonitorShape from \ContextDev\Monitors\MonitorGetResponse\MonitorsSitemapExactMonitor
 * @phpstan-import-type MonitorsPageSemanticMonitorShape from \ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor
 * @phpstan-import-type MonitorsExtractSemanticMonitorShape from \ContextDev\Monitors\MonitorGetResponse\MonitorsExtractSemanticMonitor
 *
 * @phpstan-type MonitorGetResponseVariants = MonitorsPageExactMonitor|MonitorsSitemapExactMonitor|MonitorsPageSemanticMonitor|MonitorsExtractSemanticMonitor
 * @phpstan-type MonitorGetResponseShape = MonitorGetResponseVariants|MonitorsPageExactMonitorShape|MonitorsSitemapExactMonitorShape|MonitorsPageSemanticMonitorShape|MonitorsExtractSemanticMonitorShape
 */
final class MonitorGetResponse implements ConverterSource
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
