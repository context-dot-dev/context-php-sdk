<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Batch;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Monitor;

/**
 * Batch or monitor run that produced the event.
 *
 * @phpstan-import-type BatchShape from \ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Batch
 * @phpstan-import-type MonitorShape from \ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Monitor
 *
 * @phpstan-type SourceVariants = Batch|Monitor
 * @phpstan-type SourceShape = SourceVariants|BatchShape|MonitorShape
 */
final class Source implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Batch::class, Monitor::class];
    }
}
