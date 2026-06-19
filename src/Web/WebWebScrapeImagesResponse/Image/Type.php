<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesResponse\Image;

/**
 * Format of src.
 */
enum Type: string
{
    case URL = 'url';

    case HTML = 'html';

    case BASE64 = 'base64';
}
