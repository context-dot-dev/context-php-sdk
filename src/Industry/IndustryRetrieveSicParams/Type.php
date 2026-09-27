<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryRetrieveSicParams;

/**
 * SIC dataset: `original_sic` (1987) or `latest_sec` (current SEC list).
 */
enum Type: string
{
    case ORIGINAL_SIC = 'original_sic';

    case LATEST_SEC = 'latest_sec';
}
