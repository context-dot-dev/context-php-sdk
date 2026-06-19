<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Industry\IndustryGetNaicsResponse;
use ContextDev\Industry\IndustryGetSicResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class IndustryTest extends TestCase
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
    public function testRetrieveNaics(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->industry->retrieveNaics(input: 'input');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IndustryGetNaicsResponse::class, $result);
    }

    #[Test]
    public function testRetrieveNaicsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->industry->retrieveNaics(
            input: 'input',
            maxResults: 1,
            minResults: 1,
            timeoutMs: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IndustryGetNaicsResponse::class, $result);
    }

    #[Test]
    public function testRetrieveSic(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->industry->retrieveSic(input: 'input');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IndustryGetSicResponse::class, $result);
    }

    #[Test]
    public function testRetrieveSicWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->industry->retrieveSic(
            input: 'input',
            maxResults: 1,
            minResults: 1,
            timeoutMs: 1000,
            type: 'original_sic',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(IndustryGetSicResponse::class, $result);
    }
}
