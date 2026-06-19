<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryGetSicResponse;

/**
 * Echoes back which SIC dataset was used to classify the brand.
 */
enum Classification: string
{
    case ORIGINAL_SIC = 'original_sic';

    case LATEST_SEC = 'latest_sec';
}
