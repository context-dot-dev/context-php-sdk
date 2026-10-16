<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\ServiceContracts\BrowserContract;
use ContextDev\Services\Browser\ProfilesService;

final class BrowserService implements BrowserContract
{
    /**
     * @api
     */
    public BrowserRawService $raw;

    /**
     * @api
     */
    public ProfilesService $profiles;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BrowserRawService($client);
        $this->profiles = new ProfilesService($client);
    }
}
