<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\MarkdownParams;

/**
 * How base64 images appear when `includeImages` is set (`html-conversion` only).
 */
enum InlineImages: string
{
    case PLACEHOLDER = 'placeholder';

    case PRESERVE = 'preserve';
}
