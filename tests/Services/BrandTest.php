<?php

namespace Tests\Services;

use ContextDev\Brand\BrandGetByEmailResponse;
use ContextDev\Brand\BrandGetByIsinResponse;
use ContextDev\Brand\BrandGetByNameResponse;
use ContextDev\Brand\BrandGetByTickerResponse;
use ContextDev\Brand\BrandGetResponse;
use ContextDev\Brand\BrandGetSimplifiedResponse;
use ContextDev\Brand\BrandIdentifyFromTransactionResponse;
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

        $result = $this->client->brand->retrieve(domain: 'domain');

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
            forceLanguage: 'afrikaans',
            maxAgeMs: 86400000,
            maxSpeed: true,
            timeoutMs: 1000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetResponse::class, $result);
    }

    #[Test]
    public function testIdentifyFromTransaction(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->identifyFromTransaction(
            transactionInfo: 'transaction_info'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            BrandIdentifyFromTransactionResponse::class,
            $result
        );
    }

    #[Test]
    public function testIdentifyFromTransactionWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->identifyFromTransaction(
            transactionInfo: 'transaction_info',
            city: 'city',
            countryGl: 'ad',
            forceLanguage: 'afrikaans',
            highConfidenceOnly: true,
            maxSpeed: true,
            mcc: 'mcc',
            phone: 0,
            timeoutMs: 1000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            BrandIdentifyFromTransactionResponse::class,
            $result
        );
    }

    #[Test]
    public function testRetrieveByEmail(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByEmail(email: 'dev@stainless.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByEmailResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByEmailWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByEmail(
            email: 'dev@stainless.com',
            forceLanguage: 'afrikaans',
            maxAgeMs: 86400000,
            maxSpeed: true,
            timeoutMs: 1000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByEmailResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByIsin(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByIsin(isin: 'SE60513A9993');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByIsinResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByIsinWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByIsin(
            isin: 'SE60513A9993',
            forceLanguage: 'afrikaans',
            maxAgeMs: 86400000,
            maxSpeed: true,
            timeoutMs: 1000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByIsinResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByName(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByName(name: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByNameResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByNameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByName(
            name: 'xxx',
            countryGl: 'ad',
            forceLanguage: 'afrikaans',
            maxAgeMs: 86400000,
            maxSpeed: true,
            timeoutMs: 1000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByNameResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByTicker(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByTicker(ticker: 'ticker');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByTickerResponse::class, $result);
    }

    #[Test]
    public function testRetrieveByTickerWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->brand->retrieveByTicker(
            ticker: 'ticker',
            forceLanguage: 'afrikaans',
            maxAgeMs: 86400000,
            maxSpeed: true,
            tickerExchange: 'AMEX',
            timeoutMs: 1000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BrandGetByTickerResponse::class, $result);
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
