<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountChangesResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsExtractSemanticChangeSummary;
use ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsPageExactChangeSummary;
use ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsPageSemanticChangeSummary;
use ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsSitemapExactChangeSummary;

/**
 * Union of lightweight change summaries.
 *
 * @phpstan-import-type MonitorsPageExactChangeSummaryShape from \ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsPageExactChangeSummary
 * @phpstan-import-type MonitorsSitemapExactChangeSummaryShape from \ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsSitemapExactChangeSummary
 * @phpstan-import-type MonitorsPageSemanticChangeSummaryShape from \ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsPageSemanticChangeSummary
 * @phpstan-import-type MonitorsExtractSemanticChangeSummaryShape from \ContextDev\Monitors\MonitorListAccountChangesResponse\Data\MonitorsExtractSemanticChangeSummary
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
