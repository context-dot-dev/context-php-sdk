<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsExtractSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange;

/**
 * Union of full change detail objects.
 *
 * @phpstan-import-type MonitorsPageExactChangeShape from \ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange
 * @phpstan-import-type MonitorsSitemapExactChangeShape from \ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange
 * @phpstan-import-type MonitorsPageSemanticChangeShape from \ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageSemanticChange
 * @phpstan-import-type MonitorsExtractSemanticChangeShape from \ContextDev\Monitors\MonitorGetChangeResponse\MonitorsExtractSemanticChange
 *
 * @phpstan-type MonitorGetChangeResponseVariants = MonitorsPageExactChange|MonitorsSitemapExactChange|MonitorsPageSemanticChange|MonitorsExtractSemanticChange
 * @phpstan-type MonitorGetChangeResponseShape = MonitorGetChangeResponseVariants|MonitorsPageExactChangeShape|MonitorsSitemapExactChangeShape|MonitorsPageSemanticChangeShape|MonitorsExtractSemanticChangeShape
 */
final class MonitorGetChangeResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            MonitorsPageExactChange::class,
            MonitorsSitemapExactChange::class,
            MonitorsPageSemanticChange::class,
            MonitorsExtractSemanticChange::class,
        ];
    }
}
