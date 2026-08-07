<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

/**
 * What each page will be returned as.
 */
enum Format: string
{
    case MARKDOWN = 'markdown';

    case HTML = 'html';
}
