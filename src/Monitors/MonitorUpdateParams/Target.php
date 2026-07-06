<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget;

/**
 * Discriminated union describing what the monitor watches.
 *
 * @phpstan-import-type MonitorsPageTargetShape from \ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsPageTarget
 * @phpstan-import-type MonitorsSitemapTargetShape from \ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget
 * @phpstan-import-type MonitorsExtractTargetShape from \ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsExtractTarget
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
