<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\Instruction;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\Scroll;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\Wait;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\WaitForElement;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type InstructionShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\Instruction
 * @phpstan-import-type ScrollShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\Scroll
 * @phpstan-import-type WaitShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\Wait
 * @phpstan-import-type WaitForElementShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\SharedParams\Action\WaitForElement
 *
 * @phpstan-type ActionVariants = Instruction|Scroll|Wait|WaitForElement
 * @phpstan-type ActionShape = ActionVariants|InstructionShape|ScrollShape|WaitShape|WaitForElementShape
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
            'perform' => Instruction::class,
            'scroll' => Scroll::class,
            'wait' => Wait::class,
            'waitFor' => WaitForElement::class,
        ];
    }
}
