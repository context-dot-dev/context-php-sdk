<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebExtractParams\Action\WebScrapePerformAction;
use ContextDev\Web\WebExtractParams\Action\WebScrapeWaitAction;

/**
 * Browser action discriminated by `do`. Each variant exposes only its applicable fields.
 *
 * @phpstan-import-type WebScrapeWaitActionShape from \ContextDev\Web\WebExtractParams\Action\WebScrapeWaitAction
 * @phpstan-import-type WebScrapePerformActionShape from \ContextDev\Web\WebExtractParams\Action\WebScrapePerformAction
 *
 * @phpstan-type ActionVariants = WebScrapeWaitAction|WebScrapePerformAction
 * @phpstan-type ActionShape = ActionVariants|WebScrapeWaitActionShape|WebScrapePerformActionShape
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
        ];
    }
}
