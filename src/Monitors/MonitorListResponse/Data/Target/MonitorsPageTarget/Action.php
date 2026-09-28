<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action\WebScrapePerformAction;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action\WebScrapeScrollAction;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action\WebScrapeWaitAction;

/**
 * Browser action discriminated by `do`. Each variant exposes only its applicable fields.
 *
 * @phpstan-import-type WebScrapeWaitActionShape from \ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action\WebScrapeWaitAction
 * @phpstan-import-type WebScrapePerformActionShape from \ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action\WebScrapePerformAction
 * @phpstan-import-type WebScrapeScrollActionShape from \ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget\Action\WebScrapeScrollAction
 *
 * @phpstan-type ActionVariants = WebScrapeWaitAction|WebScrapePerformAction|WebScrapeScrollAction
 * @phpstan-type ActionShape = ActionVariants|WebScrapeWaitActionShape|WebScrapePerformActionShape|WebScrapeScrollActionShape
 */
final class Action implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'do';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'wait' => WebScrapeWaitAction::class,
            'perform' => WebScrapePerformAction::class,
            'scroll' => WebScrapeScrollAction::class,
        ];
    }
}
