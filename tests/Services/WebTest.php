<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Web\WebAnswersResponse;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebMapURLsResponse;
use ContextDev\Web\WebScrapeResponse;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class WebTest extends TestCase
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
    public function testAnswers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->answers(
            task: 'Find the pricing page URL and plan names for context.dev.'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebAnswersResponse::class, $result);
    }

    #[Test]
    public function testAnswersWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->answers(
            task: 'Find the pricing page URL and plan names for context.dev.',
            jsonFormat: ['pricing_page_url' => 'bar', 'plans' => 'bar'],
            mode: 'fast',
            tags: ['production', 'team-alpha'],
            timeoutOpts: ['milliseconds' => 1000, 'behavior' => 'fail'],
            zdr: 'enabled',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebAnswersResponse::class, $result);
    }

    #[Test]
    public function testExtractCompetitors(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->extractCompetitors(domain: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractCompetitorsResponse::class, $result);
    }

    #[Test]
    public function testExtractCompetitorsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->extractCompetitors(
            domain: 'xxx',
            numCompetitors: 1,
            tags: ['production', 'team-alpha'],
            timeoutOpts: ['milliseconds' => 1000, 'behavior' => 'fail'],
            zdr: 'enabled',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractCompetitorsResponse::class, $result);
    }

    #[Test]
    public function testExtractStyleguide(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->extractStyleguide();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractStyleguideResponse::class, $result);
    }

    #[Test]
    public function testMapURLs(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->mapUrls(domain: 'xxx');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebMapURLsResponse::class, $result);
    }

    #[Test]
    public function testMapURLsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->mapUrls(
            domain: 'xxx',
            headers: ['foo' => 'J!'],
            includeSubdomains: true,
            maxLinks: 1,
            search: 'help center and troubleshooting articles',
            sitemapURL: 'https://example.com',
            tags: ['production', 'team-alpha'],
            timeoutOpts: ['milliseconds' => 1, 'behavior' => 'fail'],
            urlRegex: '^https?://[^/]+/blog/',
            zdr: 'enabled',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebMapURLsResponse::class, $result);
    }

    #[Test]
    public function testScrape(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->scrape(
            formats: [],
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebScrapeResponse::class, $result);
    }

    #[Test]
    public function testScrapeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->scrape(
            formats: [
                'bytes' => true,
                'html' => true,
                'images' => true,
                'json' => true,
                'markdown' => true,
                'parse' => true,
                'screenshot' => true,
            ],
            url: 'https://example.com',
            imageParams: ['dedupe' => 'none', 'enrich' => ['dimensions']],
            jsonParams: [
                'schema' => [
                    'type' => 'bar',
                    'properties' => 'bar',
                    'required' => 'bar',
                    'additionalProperties' => 'bar',
                ],
                'instructions' => 'instructions',
            ],
            markdownParams: [
                'includeImages' => true,
                'includeLinks' => true,
                'inlineImages' => 'placeholder',
            ],
            maxAgeMs: 0,
            parseParams: [
                'rules' => [
                    'title' => 'h1',
                    'links' => ['selector' => 'a', 'output' => '@href', 'type' => 'list'],
                ],
            ],
            screenshotParams: ['area' => 'viewport', 'format' => 'png'],
            sharedParams: [
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
                'settleAnimations' => true,
                'theme' => 'light',
                'viewport' => ['height' => 240, 'width' => 240],
                'waitFor' => 500,
            ],
            tags: ['production', 'team-alpha'],
            timeoutOpts: ['milliseconds' => 1, 'behavior' => 'fail'],
            zdr: 'enabled',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebScrapeResponse::class, $result);
    }

    #[Test]
    public function testScreenshot(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->screenshot();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebScreenshotResponse::class, $result);
    }

    #[Test]
    public function testSearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->search(query: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebSearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->search(
            query: 'x',
            country: 'af',
            excludeDomains: ['string'],
            freshness: 'last_24_hours',
            includeDomains: ['string'],
            markdownOptions: [
                'enabled' => true,
                'includeFrames' => true,
                'includeImages' => true,
                'includeLinks' => true,
                'maxAgeMs' => 0,
                'pdf' => ['end' => 1, 'shouldParse' => true, 'start' => 1],
                'shortenBase64Images' => true,
                'timeoutOpts' => ['milliseconds' => 1, 'behavior' => 'fail'],
                'useMainContentOnly' => true,
                'waitForMs' => 0,
            ],
            numResults: 10,
            queryFanout: true,
            tags: ['production', 'team-alpha'],
            timeoutOpts: ['milliseconds' => 1000, 'behavior' => 'fail'],
            zdr: 'enabled',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebSearchResponse::class, $result);
    }

    #[Test]
    public function testWebCrawlMd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webCrawlMd(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebCrawlMdResponse::class, $result);
    }

    #[Test]
    public function testWebCrawlMdWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webCrawlMd(
            url: 'https://example.com',
            country: 'de',
            excludeSelectors: ['string'],
            followSubdomains: true,
            includeFrames: true,
            includeImages: true,
            includeLinks: true,
            includeSelectors: ['string'],
            maxAgeMs: 0,
            maxDepth: 0,
            maxPages: 1,
            pdf: ['end' => 1, 'ocr' => true, 'shouldParse' => true, 'start' => 1],
            settleAnimations: true,
            shortenBase64Images: true,
            stopAfterMs: 10000,
            tags: ['production', 'team-alpha'],
            timeoutOpts: ['milliseconds' => 1000, 'behavior' => 'fail'],
            urlRegex: '^https?://[^/]+/blog/',
            useMainContentOnly: true,
            waitForMs: 0,
            zdr: 'enabled',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebCrawlMdResponse::class, $result);
    }
}
