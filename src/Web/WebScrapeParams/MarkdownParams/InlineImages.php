<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\MarkdownParams;

/**
 * How base64 images appear: `placeholder` (default) or `preserve`. Requires `includeImages`.
 */
enum InlineImages: string
{
    case PLACEHOLDER = 'placeholder';

    case PRESERVE = 'preserve';
}
