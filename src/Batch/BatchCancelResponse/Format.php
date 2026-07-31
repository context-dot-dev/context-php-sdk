<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

/**
 * What each page is returned as.
 */
enum Format: string
{
    case MARKDOWN = 'markdown';

    case HTML = 'html';
}
