<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListChangesResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsExtractSemanticChangeSummary;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageExactChangeSummary;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageSemanticChangeSummary;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsSitemapExactChangeSummary;

/**
 * Union of lightweight change summaries.
 *
 * @phpstan-import-type MonitorsPageExactChangeSummaryShape from \ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageExactChangeSummary
 * @phpstan-import-type MonitorsSitemapExactChangeSummaryShape from \ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsSitemapExactChangeSummary
 * @phpstan-import-type MonitorsPageSemanticChangeSummaryShape from \ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageSemanticChangeSummary
 * @phpstan-import-type MonitorsExtractSemanticChangeSummaryShape from \ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsExtractSemanticChangeSummary
 *
 * @phpstan-type DataVariants = MonitorsPageExactChangeSummary|MonitorsSitemapExactChangeSummary|MonitorsPageSemanticChangeSummary|MonitorsExtractSemanticChangeSummary
 * @phpstan-type DataShape = DataVariants|MonitorsPageExactChangeSummaryShape|MonitorsSitemapExactChangeSummaryShape|MonitorsPageSemanticChangeSummaryShape|MonitorsExtractSemanticChangeSummaryShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            MonitorsPageExactChangeSummary::class,
            MonitorsSitemapExactChangeSummary::class,
            MonitorsPageSemanticChangeSummary::class,
            MonitorsExtractSemanticChangeSummary::class,
        ];
    }
}
