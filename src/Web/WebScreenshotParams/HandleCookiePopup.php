<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
 */
enum HandleCookiePopup: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
