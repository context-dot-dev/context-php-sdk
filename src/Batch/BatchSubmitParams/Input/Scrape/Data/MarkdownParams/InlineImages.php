<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\MarkdownParams;

/**
 * How to write base64 images when `includeImages` is `true`: `placeholder` shortens the data, `preserve` keeps it in full (`html-conversion` only).
 */
enum InlineImages: string
{
    case PLACEHOLDER = 'placeholder';

    case PRESERVE = 'preserve';
}
