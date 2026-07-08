<?php

namespace Tests\Services;

use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
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
final class BrandTest extends TestCase
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

        $result = $this->client->brand->retrieve(
            domain: 'domain',
            type: 'by_transaction',
            name: 'xxx',
            email: 'dev@stainless.com',
            ticker: 'ticker',
            directURL: 'https://example.com',
            transactionInfo: 'xxx',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieve(
            domain: 'domain',
            type: 'by_transaction',
            forceLanguage: 'afrikaans',
            maxAgeMs: 0,
            maxSpeed: true,
            timeoutMs: 1000,
            name: 'xxx',
            countryGl: 'country_gl',
            email: 'dev@stainless.com',
            ticker: 'ticker',
            tickerExchange: 'ticker_exchange',
            directURL: 'https://example.com',
            transactionInfo: 'xxx',
            city: 'city',
            highConfidenceOnly: true,
            mcc: 0,
            phone: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveSimplified(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveSimplified(domain: 'domain');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetSimplifiedResponse::class, $result);
    }

    #[Test]
    public function testRetrieveSimplifiedWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveSimplified(
            domain: 'domain',
            maxAgeMs: 86400000,
            timeoutMs: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetSimplifiedResponse::class, $result);
    }
}
