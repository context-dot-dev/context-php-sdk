<?php

namespace Tests\Services;

use ContextDev\AI\AIExtractProductResponse;
use ContextDev\AI\AIExtractProductsResponse;
use ContextDev\Client;
use ContextDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class AITest extends TestCase
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
    public function testExtractProduct(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->ai->extractProduct(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AIExtractProductResponse::class, $result);
    }

    #[Test]
    public function testExtractProductWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->ai->extractProduct(
            url: 'https://example.com',
            maxAgeMs: 0,
            timeoutMs: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AIExtractProductResponse::class, $result);
    }

    #[Test]
    public function testExtractProducts(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->ai->extractProducts(
            domain: 'domain',
            directURL: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AIExtractProductsResponse::class, $result);
    }

    #[Test]
    public function testExtractProductsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->ai->extractProducts(
            domain: 'domain',
            maxAgeMs: 0,
            maxProducts: 1,
            timeoutMs: 1000,
            directURL: 'https://example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AIExtractProductsResponse::class, $result);
    }
}
