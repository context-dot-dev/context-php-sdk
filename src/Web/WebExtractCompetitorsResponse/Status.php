<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractCompetitorsResponse;

/**
 * Always `ok` on success.
 */
enum Status: string
{
    case OK = 'ok';
}
