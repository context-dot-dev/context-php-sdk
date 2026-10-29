<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\Perform;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\Scroll;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\Wait;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\WaitFor;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type PerformShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\Perform
 * @phpstan-import-type ScrollShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\Scroll
 * @phpstan-import-type WaitShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\Wait
 * @phpstan-import-type WaitForShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\WaitFor
 *
 * @phpstan-type ActionVariants = Perform|Scroll|Wait|\ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams\Action\WaitFor
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
