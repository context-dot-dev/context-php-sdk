<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

/**
 * Output format.
 */
enum Type: string
{
    case MARKDOWN = 'markdown';

    case HTML = 'html';
}
