<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Utility\UtilityPrefetchByEmailResponse;
use ContextDev\Utility\UtilityPrefetchResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class UtilityTest extends TestCase
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
    public function testPrefetch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->utility->prefetch(domain: 'domain');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UtilityPrefetchResponse::class, $result);
    }

    #[Test]
    public function testPrefetchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->utility->prefetch(
            domain: 'domain',
            timeoutMs: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UtilityPrefetchResponse::class, $result);
    }

    #[Test]
    public function testPrefetchByEmail(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->utility->prefetchByEmail(
            email: 'dev@stainless.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UtilityPrefetchByEmailResponse::class, $result);
    }

    #[Test]
    public function testPrefetchByEmailWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->utility->prefetchByEmail(
            email: 'dev@stainless.com',
            timeoutMs: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UtilityPrefetchByEmailResponse::class, $result);
    }
}
