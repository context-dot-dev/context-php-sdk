<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsSitemapTarget;

/**
 * Discriminated union describing what the monitor watches.
 *
 * @phpstan-import-type MonitorsPageTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsPageTarget
 * @phpstan-import-type MonitorsSitemapTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsSitemapTarget
 * @phpstan-import-type MonitorsExtractTargetShape from \ContextDev\Monitors\MonitorUpdateResponse\Target\MonitorsExtractTarget
 *
 * @phpstan-type TargetVariants = MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget
 * @phpstan-type TargetShape = TargetVariants|MonitorsPageTargetShape|MonitorsSitemapTargetShape|MonitorsExtractTargetShape
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
        ];
    }
}
