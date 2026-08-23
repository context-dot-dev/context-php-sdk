<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\Action\WebScrapePerformAction;
use ContextDev\Web\WebWebScrapeMdParams\Action\WebScrapeScrollAction;
use ContextDev\Web\WebWebScrapeMdParams\Action\WebScrapeWaitAction;

/**
 * Browser action discriminated by `do`. Each variant exposes only its applicable fields.
 *
 * @phpstan-import-type WebScrapeWaitActionShape from \ContextDev\Web\WebWebScrapeMdParams\Action\WebScrapeWaitAction
 * @phpstan-import-type WebScrapePerformActionShape from \ContextDev\Web\WebWebScrapeMdParams\Action\WebScrapePerformAction
 * @phpstan-import-type WebScrapeScrollActionShape from \ContextDev\Web\WebWebScrapeMdParams\Action\WebScrapeScrollAction
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
