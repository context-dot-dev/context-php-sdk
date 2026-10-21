<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\MarkdownParams;

enum SourcePreference: string
{
    case HTML_CONVERSION = 'html-conversion';

    case MARKDOWN_DIRECT = 'markdown-direct';
}
