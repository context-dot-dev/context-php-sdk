<?php

declare(strict_types=1);

namespace ContextDev\Industry\IndustryGetSicResponse\Code;

/**
 * Confidence level for how well this SIC code matches the company description.
 */
enum Confidence: string
{
    case HIGH = 'high';

    case MEDIUM = 'medium';

    case LOW = 'low';
}
