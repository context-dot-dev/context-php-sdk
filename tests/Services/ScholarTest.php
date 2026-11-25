<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Scholar\ScholarSearchResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ScholarTest extends TestCase
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
    public function testSearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->scholar->search(
            query: 'CRISPR off-target effects in human cells'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ScholarSearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->scholar->search(
            query: 'CRISPR off-target effects in human cells',
            cursor: 'cursor',
            filterBy: ['date' => ['from' => 0, 'to' => 0]],
            limit: 1,
            sort: 'relevance',
            tags: ['production', 'team-alpha'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ScholarSearchResponse::class, $result);
    }
}
