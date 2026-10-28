<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsSearchTarget;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsSitemapTarget;

/**
 * What to watch: a page, a sitemap, data extracted from a site, or web search results.
 *
 * @phpstan-import-type MonitorsPageTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsPageTarget
 * @phpstan-import-type MonitorsSitemapTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsSitemapTarget
 * @phpstan-import-type MonitorsExtractTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsExtractTarget
 * @phpstan-import-type MonitorsSearchTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsSearchTarget
 *
 * @phpstan-type TargetVariants = MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget
 * @phpstan-type TargetShape = TargetVariants|MonitorsPageTargetShape|MonitorsSitemapTargetShape|MonitorsExtractTargetShape|MonitorsSearchTargetShape
 */
final class Target implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'page' => MonitorsPageTarget::class,
            'sitemap' => MonitorsSitemapTarget::class,
            'extract' => MonitorsExtractTarget::class,
            'search' => MonitorsSearchTarget::class,
        ];
    }
}
