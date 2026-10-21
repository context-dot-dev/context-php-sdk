<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\MarkdownParams;

/**
 * How base64 images appear: `placeholder` (default) or `preserve`. Requires `includeImages`. Only applies to `html-conversion` extractions.
 */
enum InlineImages: string
{
    case PLACEHOLDER = 'placeholder';

    case PRESERVE = 'preserve';
}
