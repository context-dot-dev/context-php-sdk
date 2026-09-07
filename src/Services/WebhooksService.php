<?php

declare(strict_types=1);

namespace ContextDev\Services;

use ContextDev\Client;
use ContextDev\ServiceContracts\WebhooksContract;
use ContextDev\Services\Webhooks\DeliveriesService;

final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @api
     */
    public DeliveriesService $deliveries;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
        $this->deliveries = new DeliveriesService($client);
    }
}
