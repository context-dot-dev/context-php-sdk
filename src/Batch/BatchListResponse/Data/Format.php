<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

/**
 * What each page is returned as. Matches `input.data.format` on the submit request.
 */
enum Format: string
{
    case MARKDOWN = 'markdown';

    case HTML = 'html';
}
