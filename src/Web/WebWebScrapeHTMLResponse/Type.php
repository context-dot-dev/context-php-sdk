<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLResponse;

/**
 * Detected content type of the returned `html` field. Sitemaps and feeds are surfaced as `xml`; ordinary pages are `html`.
 */
enum Type: string
{
    case HTML = 'html';

    case XML = 'xml';

    case JSON = 'json';

    case TEXT = 'text';

    case CSV = 'csv';

    case MARKDOWN = 'markdown';

    case SVG = 'svg';

    case PDF = 'pdf';

    case DOCX = 'docx';

    case DOC = 'doc';
}
