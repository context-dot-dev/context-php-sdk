<?php

declare(strict_types=1);

namespace ContextDev\Feedback\FeedbackSubmitParams;

/**
 * Kind of issue. Use `quality_degradation` for wrong or incomplete results and `bad_brand` for wrong or outdated brand data, such as a logo or colors.
 */
enum Category: string
{
    case BUG = 'bug';

    case DOCS_MISMATCH = 'docs_mismatch';

    case FRICTION = 'friction';

    case FEATURE_GAP = 'feature_gap';

    case QUALITY_DEGRADATION = 'quality_degradation';

    case BAD_BRAND = 'bad_brand';

    case OTHER = 'other';
}
