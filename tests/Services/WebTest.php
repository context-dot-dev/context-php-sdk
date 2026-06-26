<?php

namespace Tests\Services;

use ContextDev\Client;
use ContextDev\Core\Util;
use ContextDev\Web\WebExtractCompetitorsResponse;
use ContextDev\Web\WebExtractFontsResponse;
use ContextDev\Web\WebExtractResponse;
use ContextDev\Web\WebExtractStyleguideResponse;
use ContextDev\Web\WebScreenshotResponse;
use ContextDev\Web\WebSearchResponse;
use ContextDev\Web\WebWebCrawlMdResponse;
use ContextDev\Web\WebWebScrapeHTMLResponse;
use ContextDev\Web\WebWebScrapeImagesResponse;
use ContextDev\Web\WebWebScrapeMdResponse;
use ContextDev\Web\WebWebScrapeSitemapResponse;
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
    public function testExtract(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->extract(
            schema: [
                'type' => 'bar',
                'properties' => 'bar',
                'required' => 'bar',
                'additionalProperties' => 'bar',
            ],
            url: 'https://example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractResponse::class, $result);
    }

    #[Test]
    public function testExtractWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->extract(
            schema: [
                'type' => 'bar',
                'properties' => 'bar',
                'required' => 'bar',
                'additionalProperties' => 'bar',
            ],
            url: 'https://example.com',
            factCheck: true,
            followSubdomains: true,
            includeFrames: true,
            instructions: 'instructions',
            maxAgeMs: 0,
            maxDepth: 0,
            maxPages: 1,
            pdf: ['end' => 1, 'shouldParse' => true, 'start' => 1],
            stopAfterMs: 10000,
            timeoutMs: 1000,
            waitForMs: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractResponse::class, $result);
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
            timeoutMs: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractCompetitorsResponse::class, $result);
    }

    #[Test]
    public function testExtractFonts(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->extractFonts();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebExtractFontsResponse::class, $result);
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
                'timeoutMs' => 1000,
                'useMainContentOnly' => true,
                'waitForMs' => 0,
            ],
            queryFanout: true,
            timeoutMs: 1000,
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
            pdf: ['end' => 1, 'shouldParse' => true, 'start' => 1],
            shortenBase64Images: true,
            stopAfterMs: 10000,
            timeoutMs: 1000,
            urlRegex: '^https?://[^/]+/blog/',
            useMainContentOnly: true,
            waitForMs: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebCrawlMdResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeHTML(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeHTML(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeHTMLResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeHTMLWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeHTML(
            url: 'https://example.com',
            country: 'de',
            excludeSelectors: ['string'],
            headers: ['foo' => 'J!'],
            includeFrames: true,
            includeSelectors: ['string'],
            maxAgeMs: 0,
            pdf: ['end' => 1, 'shouldParse' => true, 'start' => 1],
            timeoutMs: 1000,
            useMainContentOnly: true,
            waitForMs: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeHTMLResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeImages(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeImages(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeImagesResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeImagesWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeImages(
            url: 'https://example.com',
            enrichment: [
                'classification' => true,
                'hostedURL' => true,
                'maxTimePerMs' => 1,
                'resolution' => true,
            ],
            headers: ['foo' => 'J!'],
            maxAgeMs: 0,
            timeoutMs: 1000,
            waitForMs: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeImagesResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeMd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeMd(url: 'https://example.com');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeMdResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeMdWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeMd(
            url: 'https://example.com',
            country: 'de',
            excludeSelectors: ['string'],
            headers: ['foo' => 'J!'],
            includeFrames: true,
            includeImages: true,
            includeLinks: true,
            includeSelectors: ['string'],
            maxAgeMs: 0,
            pdf: ['end' => 1, 'shouldParse' => true, 'start' => 1],
            shortenBase64Images: true,
            timeoutMs: 1000,
            useMainContentOnly: true,
            waitForMs: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeMdResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeSitemap(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeSitemap(domain: 'domain');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeSitemapResponse::class, $result);
    }

    #[Test]
    public function testWebScrapeSitemapWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->web->webScrapeSitemap(
            domain: 'domain',
            headers: ['foo' => 'J!'],
            maxLinks: 1,
            timeoutMs: 1000,
            urlRegex: '^https?://[^/]+/blog/',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebWebScrapeSitemapResponse::class, $result);
    }
}
