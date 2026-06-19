<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractCompetitorsResponse\Competitor;

/**
 * Confidence that this company is a direct competitor.
 */
enum Confidence: string
{
    case HIGH = 'high';

    case MEDIUM = 'medium';
}
