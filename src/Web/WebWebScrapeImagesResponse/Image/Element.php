<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesResponse\Image;

/**
 * Where the image was found.
 */
enum Element: string
{
    case IMG = 'img';

    case SVG = 'svg';

    case LINK = 'link';

    case SOURCE = 'source';

    case VIDEO = 'video';

    case CSS = 'css';

    case OBJECT = 'object';

    case META = 'meta';

    case BACKGROUND = 'background';
}
