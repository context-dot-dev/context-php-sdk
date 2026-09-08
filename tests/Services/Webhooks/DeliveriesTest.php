<?php

namespace Tests\Services\Webhooks;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Webhooks\Deliveries\DeliveryGetResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListAttemptsResponse;
use ContextDev\Webhooks\Deliveries\DeliveryListResponse;
use ContextDev\Webhooks\Deliveries\DeliveryRetryResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class DeliveriesTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->deliveries->retrieve(
            'whd_210b9798eb53baa4e69d31c1071cf03d'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeliveryGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->deliveries->list(type: 'monitor');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeliveryListResponse::class, $result);
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->deliveries->list(
            type: 'monitor',
            batchID: 'batch_id',
            createdAfter: new \DateTimeImmutable('2026-09-01T00:00:00Z'),
            cursor: 'whd_210b9798eb53baa4e69d31c1071cf03d',
            limit: 1,
            status: 'pending',
            tags: ['production', 'team-alpha'],
            monitorID: 'monitor_id',
            runID: 'run_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeliveryListResponse::class, $result);
    }

    #[Test]
    public function testListAttempts(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->deliveries->listAttempts(
            'whd_210b9798eb53baa4e69d31c1071cf03d'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeliveryListAttemptsResponse::class, $result);
    }

    #[Test]
    public function testRetry(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->deliveries->retry(
            'whd_210b9798eb53baa4e69d31c1071cf03d'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeliveryRetryResponse::class, $result);
    }
}
