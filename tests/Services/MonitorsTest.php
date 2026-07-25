<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Monitors\MonitorDeleteResponse;
use ContextDev\Monitors\MonitorGetChangeResponse;
use ContextDev\Monitors\MonitorGetCreditUsageResponse;
use ContextDev\Monitors\MonitorGetLimitsResponse;
use ContextDev\Monitors\MonitorGetResponse;
use ContextDev\Monitors\MonitorListAccountChangesResponse;
use ContextDev\Monitors\MonitorListAccountRunsResponse;
use ContextDev\Monitors\MonitorListChangesResponse;
use ContextDev\Monitors\MonitorListResponse;
use ContextDev\Monitors\MonitorListRunsResponse;
use ContextDev\Monitors\MonitorNewResponse;
use ContextDev\Monitors\MonitorRunResponse;
use ContextDev\Monitors\MonitorUpdateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class MonitorsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->create(
            name: 'Acme pricing page',
            target: ['type' => 'page', 'url' => 'https://acme.com/pricing'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->create(
            name: 'Acme pricing page',
            target: [
                'type' => 'page',
                'url' => 'https://acme.com/pricing',
                'normalizeWhitespace' => true,
            ],
            changeDetection: ['type' => 'exact'],
            mode: 'web',
            schedule: ['frequency' => 6, 'type' => 'interval', 'unit' => 'hours'],
            tags: ['pricing', 'competitor'],
            webhook: [
                'url' => 'https://example.com/webhook',
                'events' => ['change.detected', 'run.completed'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->retrieve('mon_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorGetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->update('mon_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorUpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->delete('mon_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorDeleteResponse::class, $result);
    }

    #[Test]
    public function testGetCreditUsage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->getCreditUsage();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorGetCreditUsageResponse::class, $result);
    }

    #[Test]
    public function testGetLimits(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->getLimits();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorGetLimitsResponse::class, $result);
    }

    #[Test]
    public function testListAccountChanges(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->listAccountChanges();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorListAccountChangesResponse::class, $result);
    }

    #[Test]
    public function testListAccountRuns(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->listAccountRuns();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorListAccountRunsResponse::class, $result);
    }

    #[Test]
    public function testListChanges(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->listChanges('mon_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorListChangesResponse::class, $result);
    }

    #[Test]
    public function testListRuns(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->listRuns('mon_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorListRunsResponse::class, $result);
    }

    #[Test]
    public function testRetrieveChange(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->retrieveChange('chg_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorGetChangeResponse::class, $result);
    }

    #[Test]
    public function testRun(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->monitors->run('mon_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MonitorRunResponse::class, $result);
    }
}
