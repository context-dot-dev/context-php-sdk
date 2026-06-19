<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractParams\Pdf;

/**
 * Crawl a website, use the provided JSON Schema and instructions to prioritize relevant internal links, and extract structured data from the selected pages.
 *
 * @see ContextDev\Services\WebService::extract()
 *
 * @phpstan-import-type PdfShape from \ContextDev\Web\WebExtractParams\Pdf
 *
 * @phpstan-type WebExtractParamsShape = array{
 *   schema: array<string,mixed>,
 *   url: string,
 *   factCheck?: bool|null,
 *   followSubdomains?: bool|null,
 *   includeFrames?: bool|null,
 *   instructions?: string|null,
 *   maxAgeMs?: int|null,
 *   maxDepth?: int|null,
 *   maxPages?: int|null,
 *   pdf?: null|Pdf|PdfShape,
 *   stopAfterMs?: int|null,
 *   timeoutMs?: int|null,
 *   waitForMs?: int|null,
 * }
 */
final class WebExtractParams implements BaseModel
{
    /** @use SdkModel<WebExtractParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * JSON Schema for the returned data object. TypeScript Zod users can pass a JSON Schema generated from a Zod object; Python users can pass the equivalent JSON Schema object.
     *
     * @var array<string,mixed> $schema
     */
    #[Required(map: 'mixed')]
    public array $schema;

    /**
     * The starting website URL to crawl and extract from. Must include http:// or https://.
     */
    #[Required]
    public string $url;

    /**
     * When true, every returned value must be grounded in facts stated on the page; fields that cannot be supported by the page are returned as null/empty. When false (default), the model may make reasonable inferences and derivations from the page content (e.g. ideal customer, competitor analysis, recommendations) while keeping verifiable specifics (names, quotes, URLs, dates, metrics) faithful to the source.
     */
    #[Optional]
    public ?bool $factCheck;

    /**
     * When true, follow links on subdomains of the starting URL's domain.
     */
    #[Optional]
    public ?bool $followSubdomains;

    /**
     * When true, iframe contents are included in Markdown before extraction.
     */
    #[Optional]
    public ?bool $includeFrames;

    /**
     * Optional extraction guidance, such as which facts to prioritize or how to interpret fields in the schema.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * Return cached scrape results if a prior scrape for the same parameters is younger than this many milliseconds. Defaults to 7 days (604800000 ms).
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Optional maximum link depth from the starting URL (0 = only the starting page). If omitted, there is no crawl depth limit.
     */
    #[Optional]
    public ?int $maxDepth;

    /**
     * Maximum number of pages to analyze for extraction. Hard cap: 50. Defaults to 5.
     */
    #[Optional]
    public ?int $maxPages;

    #[Optional]
    public ?Pdf $pdf;

    /**
     * Soft time budget for the crawl in milliseconds. Min: 10000 (10s). Max: 110000 (110s). Default: 80000 (80s).
     */
    #[Optional]
    public ?int $stopAfterMs;

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    #[Optional('timeoutMS')]
    public ?int $timeoutMs;

    /**
     * Optional browser wait time in milliseconds after initial page load for each crawled page.
     */
    #[Optional]
    public ?int $waitForMs;

    /**
     * `new WebExtractParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractParams::with(schema: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractParams)->withSchema(...)->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed> $schema
     * @param Pdf|PdfShape|null $pdf
     */
    public static function with(
        array $schema,
        string $url,
        ?bool $factCheck = null,
        ?bool $followSubdomains = null,
        ?bool $includeFrames = null,
        ?string $instructions = null,
        ?int $maxAgeMs = null,
        ?int $maxDepth = null,
        ?int $maxPages = null,
        Pdf|array|null $pdf = null,
        ?int $stopAfterMs = null,
        ?int $timeoutMs = null,
        ?int $waitForMs = null,
    ): self {
        $self = new self;

        $self['schema'] = $schema;
        $self['url'] = $url;

        null !== $factCheck && $self['factCheck'] = $factCheck;
        null !== $followSubdomains && $self['followSubdomains'] = $followSubdomains;
        null !== $includeFrames && $self['includeFrames'] = $includeFrames;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $maxDepth && $self['maxDepth'] = $maxDepth;
        null !== $maxPages && $self['maxPages'] = $maxPages;
        null !== $pdf && $self['pdf'] = $pdf;
        null !== $stopAfterMs && $self['stopAfterMs'] = $stopAfterMs;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $waitForMs && $self['waitForMs'] = $waitForMs;

        return $self;
    }

    /**
     * JSON Schema for the returned data object. TypeScript Zod users can pass a JSON Schema generated from a Zod object; Python users can pass the equivalent JSON Schema object.
     *
     * @param array<string,mixed> $schema
     */
    public function withSchema(array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

        return $self;
    }

    /**
     * The starting website URL to crawl and extract from. Must include http:// or https://.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * When true, every returned value must be grounded in facts stated on the page; fields that cannot be supported by the page are returned as null/empty. When false (default), the model may make reasonable inferences and derivations from the page content (e.g. ideal customer, competitor analysis, recommendations) while keeping verifiable specifics (names, quotes, URLs, dates, metrics) faithful to the source.
     */
    public function withFactCheck(bool $factCheck): self
    {
        $self = clone $this;
        $self['factCheck'] = $factCheck;

        return $self;
    }

    /**
     * When true, follow links on subdomains of the starting URL's domain.
     */
    public function withFollowSubdomains(bool $followSubdomains): self
    {
        $self = clone $this;
        $self['followSubdomains'] = $followSubdomains;

        return $self;
    }

    /**
     * When true, iframe contents are included in Markdown before extraction.
     */
    public function withIncludeFrames(bool $includeFrames): self
    {
        $self = clone $this;
        $self['includeFrames'] = $includeFrames;

        return $self;
    }

    /**
     * Optional extraction guidance, such as which facts to prioritize or how to interpret fields in the schema.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Return cached scrape results if a prior scrape for the same parameters is younger than this many milliseconds. Defaults to 7 days (604800000 ms).
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Optional maximum link depth from the starting URL (0 = only the starting page). If omitted, there is no crawl depth limit.
     */
    public function withMaxDepth(int $maxDepth): self
    {
        $self = clone $this;
        $self['maxDepth'] = $maxDepth;

        return $self;
    }

    /**
     * Maximum number of pages to analyze for extraction. Hard cap: 50. Defaults to 5.
     */
    public function withMaxPages(int $maxPages): self
    {
        $self = clone $this;
        $self['maxPages'] = $maxPages;

        return $self;
    }

    /**
     * @param Pdf|PdfShape $pdf
     */
    public function withPdf(Pdf|array $pdf): self
    {
        $self = clone $this;
        $self['pdf'] = $pdf;

        return $self;
    }

    /**
     * Soft time budget for the crawl in milliseconds. Min: 10000 (10s). Max: 110000 (110s). Default: 80000 (80s).
     */
    public function withStopAfterMs(int $stopAfterMs): self
    {
        $self = clone $this;
        $self['stopAfterMs'] = $stopAfterMs;

        return $self;
    }

    /**
     * Optional timeout in milliseconds for the request. If the request takes longer than this value, it will be aborted with a 408 status code. Maximum allowed value is 300000ms (5 minutes).
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Optional browser wait time in milliseconds after initial page load for each crawled page.
     */
    public function withWaitForMs(int $waitForMs): self
    {
        $self = clone $this;
        $self['waitForMs'] = $waitForMs;

        return $self;
    }
}
