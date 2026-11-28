<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchResponse\Data;

/**
 * Format of the full text at `full_text_url`. `jats` is JATS XML.
 */
enum FullTextFormat: string
{
    case PDF = 'pdf';

    case HTML = 'html';

    case JATS = 'jats';
}
