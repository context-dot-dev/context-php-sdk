<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryRetrieveSicParams;

/**
 * Which SIC dataset to classify against. `original_sic` uses the 1987 Standard Industrial Classification system; `latest_sec` uses the current SIC list as published by the SEC. Defaults to `original_sic`.
 */
enum Type: string
{
    case ORIGINAL_SIC = 'original_sic';

    case LATEST_SEC = 'latest_sec';
}
