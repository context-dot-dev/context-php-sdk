<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Markdown\Options;

enum SourcePreference: string
{
    case HTML_CONVERSION = 'html-conversion';

    case MARKDOWN_DIRECT = 'markdown-direct';
}
