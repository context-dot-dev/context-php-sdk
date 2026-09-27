<?php

declare(strict_types=1);

namespace ContextDev\Feedback\FeedbackSubmitParams;

/**
 * Kind of issue.
 */
enum Category: string
{
    case BUG = 'bug';

    case DOCS_MISMATCH = 'docs_mismatch';

    case FRICTION = 'friction';

    case FEATURE_GAP = 'feature_gap';

    case QUALITY_DEGRADATION = 'quality_degradation';

    case OTHER = 'other';
}
