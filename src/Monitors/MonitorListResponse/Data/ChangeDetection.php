<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection\MonitorsSemanticChangeDetection;

/**
 * Discriminated union describing how changes are detected.
 *
 * @phpstan-import-type MonitorsExactChangeDetectionShape from \ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection\MonitorsExactChangeDetection
 * @phpstan-import-type MonitorsSemanticChangeDetectionShape from \ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection\MonitorsSemanticChangeDetection
 *
 * @phpstan-type ChangeDetectionVariants = MonitorsExactChangeDetection|MonitorsSemanticChangeDetection
 * @phpstan-type ChangeDetectionShape = ChangeDetectionVariants|MonitorsExactChangeDetectionShape|MonitorsSemanticChangeDetectionShape
 */
final class ChangeDetection implements ConverterSource
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
            'exact' => MonitorsExactChangeDetection::class,
            'semantic' => MonitorsSemanticChangeDetection::class,
        ];
    }
}
