<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\MarkdownParams;

/**
 * Base64 images use placeholders by default. Requires includeImages: true.
 */
enum InlineImages: string
{
    case PLACEHOLDER = 'placeholder';

    case PRESERVE = 'preserve';
}
