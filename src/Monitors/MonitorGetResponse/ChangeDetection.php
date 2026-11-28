<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorGetResponse\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorGetResponse\ChangeDetection\MonitorsSemanticChangeDetection;

/**
 * How changes are judged. Defaults to `semantic` for extract and search targets and for page targets with `instructions`; otherwise `exact`. Sitemap targets support only `exact`, and extract targets only `semantic`.
 *
 * @phpstan-import-type MonitorsExactChangeDetectionShape from \ContextDev\Monitors\MonitorGetResponse\ChangeDetection\MonitorsExactChangeDetection
 * @phpstan-import-type MonitorsSemanticChangeDetectionShape from \ContextDev\Monitors\MonitorGetResponse\ChangeDetection\MonitorsSemanticChangeDetection
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
