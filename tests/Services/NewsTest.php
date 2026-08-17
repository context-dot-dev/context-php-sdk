<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\News\NewsSearchResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class NewsTest extends TestCase
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

        $result = $this->client->news->search(
            searchBy: [
                'entity' => ['name' => 'xx', 'type' => 'name'], 'type' => 'entity',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NewsSearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->news->search(
            searchBy: [
                'entity' => ['name' => 'xx', 'type' => 'name'], 'type' => 'entity',
            ],
            cursor: 'cursor',
            filterBy: [
                'articleLanguage' => ['ar'],
                'articleType' => ['editorial'],
                'date' => ['from' => 0, 'to' => 0],
                'sourceCountry' => ['ae'],
                'sourceDomain' => ['x'],
            ],
            limit: 1,
            sortBy: ['type' => 'relevance'],
            tags: ['production', 'team-alpha'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NewsSearchResponse::class, $result);
    }
}
