<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotResponse;

/**
 * How complete the returned content is. `loaded` means the page finished the waits the request asked for. `still-loading` only occurs with timeoutOpts.behavior=return-partial: the timeoutOpts.milliseconds deadline was reached first, so the content reflects the DOM at that moment and late-rendering parts may be missing. Partial results are billed at the base request cost.
 */
enum FinalDomState: string
{
    case LOADED = 'loaded';

    case STILL_LOADING = 'still-loading';
}
