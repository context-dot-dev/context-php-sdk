<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse;

/**
 * `loaded`, or `still-loading` when capture ended before the page finished loading.
 */
enum FinalDomState: string
{
    case LOADED = 'loaded';

    case STILL_LOADING = 'still-loading';
}
