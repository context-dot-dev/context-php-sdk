<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Instruction;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Wait;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\WaitForElement;

/**
 * @phpstan-import-type InstructionShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Instruction
 * @phpstan-import-type ScrollShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll
 * @phpstan-import-type WaitShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\Wait
 * @phpstan-import-type WaitForElementShape from \ContextDev\Web\WebScrapeParams\SharedParams\Action\WaitForElement
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
