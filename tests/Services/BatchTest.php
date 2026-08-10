<?php

namespace Tests\Services;

use ContextDev\Batch\BatchCancelResponse;
use ContextDev\Batch\BatchDeleteResponse;
use ContextDev\Batch\BatchGetResponse;
use ContextDev\Batch\BatchGetResultsResponse;
use ContextDev\Batch\BatchListResponse;
use ContextDev\Batch\BatchSubmitResponse;
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
final class BatchTest extends TestCase
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

        $result = $this->client->batch->retrieve('batch_9f2c8a');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->batch->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->batch->delete('batch_9f2c8a');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchDeleteResponse::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->batch->cancel('batch_9f2c8a');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchCancelResponse::class, $result);
    }

    #[Test]
    public function testGetResults(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->batch->getResults('batch_9f2c8a');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchGetResultsResponse::class, $result);
    }

    #[Test]
    public function testSubmit(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->batch->submit(
            input: [
                'data' => [
                    'format' => 'markdown',
                    'urls' => [
                        ['url' => 'https://example.com/products/anvil'],
                        ['url' => 'https://example.com/products/hammer'],
                    ],
                ],
                'mode' => 'scrape',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchSubmitResponse::class, $result);
    }

    #[Test]
    public function testSubmitWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->batch->submit(
            input: [
                'data' => [
                    'format' => 'markdown',
                    'urls' => [
                        [
                            'url' => 'https://example.com/products/anvil',
                            'itemID' => 'sku-1',
                            'meta' => ['category' => 'bar'],
                        ],
                        [
                            'url' => 'https://example.com/products/hammer',
                            'itemID' => 'sku-2',
                            'meta' => ['foo' => 'bar'],
                        ],
                    ],
                    'options' => [
                        'country' => 'de',
                        'excludeSelectors' => ['x'],
                        'includeHTML' => true,
                        'includeImages' => true,
                        'includeLinks' => true,
                        'includeSelectors' => ['x'],
                        'maxAgeMs' => 0,
                        'pdf' => [
                            'end' => 1, 'ocr' => 'true', 'shouldParse' => 'true', 'start' => 1,
                        ],
                        'settleAnimations' => true,
                        'shortenBase64Images' => true,
                        'useMainContentOnly' => true,
                        'waitForMs' => 0,
                    ],
                ],
                'mode' => 'scrape',
            ],
            tags: ['docs', 'competitor'],
            webhookURL: 'webhookUrl',
            idempotencyKey: 'Idempotency-Key',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchSubmitResponse::class, $result);
    }
}
