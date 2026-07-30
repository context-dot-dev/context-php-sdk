<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse\Metadata;

enum SourcesAttempted: string
{
    case LINKEDIN = 'linkedin';

    case CV = 'cv';

    case MANUAL = 'manual';

    case GITHUB = 'github';

    case OTHER = 'other';
}
