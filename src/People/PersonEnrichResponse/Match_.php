<?php

declare(strict_types=1);

namespace ContextDev\People\PersonEnrichResponse;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch;
use ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentNotFoundMatch;

/**
 * The highest-scoring person candidate.
 *
 * @phpstan-import-type PersonEnrichmentCandidateMatchShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentCandidateMatch
 * @phpstan-import-type PersonEnrichmentNotFoundMatchShape from \ContextDev\People\PersonEnrichResponse\Match_\PersonEnrichmentNotFoundMatch
 *
 * @phpstan-type MatchVariants = PersonEnrichmentCandidateMatch|PersonEnrichmentNotFoundMatch
 * @phpstan-type MatchShape = MatchVariants|PersonEnrichmentCandidateMatchShape|PersonEnrichmentNotFoundMatchShape
 */
final class Match_ implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'status';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'candidate' => PersonEnrichmentCandidateMatch::class,
            'not_found' => PersonEnrichmentNotFoundMatch::class,
        ];
    }
}
