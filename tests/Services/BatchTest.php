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
                    'formats' => [],
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
                    'formats' => [
                        'bytes' => true,
                        'highlights' => true,
                        'html' => true,
                        'images' => true,
                        'json' => true,
                        'markdown' => true,
                        'parse' => true,
                        'product' => true,
                        'screenshot' => true,
                    ],
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
                    'highlightsParams' => ['query' => 'x', 'maxCharacters' => 100],
                    'imageParams' => ['dedupe' => 'none', 'enrich' => ['dimensions']],
                    'jsonParams' => [
                        'schema' => [
                            'type' => 'bar',
                            'properties' => 'bar',
                            'required' => 'bar',
                            'additionalProperties' => 'bar',
                        ],
                        'instructions' => 'instructions',
                    ],
                    'markdownParams' => [
                        'includeImages' => true,
                        'includeLinks' => true,
                        'inlineImages' => 'placeholder',
                    ],
                    'maxAgeMs' => 0,
                    'parseParams' => [
                        'rules' => [
                            'title' => 'h1',
                            'links' => [
                                'selector' => 'a', 'output' => '@href', 'type' => 'list',
                            ],
                        ],
                        'type' => 'custom',
                    ],
                    'productParams' => ['dedupeImages' => true],
                    'screenshotParams' => ['area' => 'viewport', 'format' => 'png'],
                    'sharedParams' => [
                        'actions' => [
                            ['action' => 'Click the product details tab', 'type' => 'perform'],
                        ],
                        'country' => 'US',
                        'dismissCookies' => true,
                        'dismissPopups' => true,
                        'excludeSelectors' => ['P'],
                        'headers' => ['Accept-Language' => 'en-US'],
                        'includeFrames' => true,
                        'includeSelectors' => ['P'],
                        'mainContentOnly' => true,
                        'parsers' => [
                            'pdf' => ['endPage' => 1, 'ocr' => 'off', 'startPage' => 1],
                        ],
                        'profile' => [
                            'profileID' => 'prof_210b9798eb53baa4e69d31c1071cf03d',
                            'type' => 'existing',
                        ],
                        'settleAnimations' => true,
                        'theme' => 'light',
                        'viewport' => ['height' => 240, 'width' => 240],
                        'waitFor' => 500,
                    ],
                    'tags' => ['production', 'team-alpha'],
                    'timeoutOpts' => ['milliseconds' => 1, 'behavior' => 'fail'],
                    'zdr' => 'disabled',
                ],
                'mode' => 'scrape',
            ],
            tags: ['docs', 'competitor'],
            webhook: [
                'url' => 'https://example.com',
                'retry' => ['delaysSeconds' => [10, 60, 300, 1800, 7200, 21600, 57600]],
            ],
            webhookURL: 'https://example.com',
            idempotencyKey: 'Idempotency-Key',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BatchSubmitResponse::class, $result);
    }
}
