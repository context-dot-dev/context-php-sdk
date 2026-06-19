<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryGetNaicsResponse\Code;

/**
 * Confidence level for how well this NAICS code matches the company description.
 */
enum Confidence: string
{
    case HIGH = 'high';

    case MEDIUM = 'medium';

    case LOW = 'low';
}
