<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchResponse\Data;

/**
 * Format of the linked full text. jats is XML.
 */
enum FullTextFormat: string
{
    case PDF = 'pdf';

    case HTML = 'html';

    case JATS = 'jats';
}
