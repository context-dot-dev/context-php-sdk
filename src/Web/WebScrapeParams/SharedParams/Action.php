<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Perform;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Wait;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\WaitFor;

/**
 * @phpstan-import-type PerformShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Perform
 * @phpstan-import-type ScrollShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll
 * @phpstan-import-type WaitShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Wait
 * @phpstan-import-type WaitForShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\WaitFor
 *
 * @phpstan-type ActionVariants = Perform|Scroll|Wait|\ContextDev\Web\WebScrapeParams\SharedParams\Action\WaitFor
 * @phpstan-type ActionShape = ActionVariants|PerformShape|ScrollShape|WaitShape|WaitForShape
 */
final class Action implements ConverterSource
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
            'perform' => Perform::class,
            'scroll' => Scroll::class,
            'wait' => Wait::class,
            'waitFor' => WaitFor::class,
        ];
    }
}
