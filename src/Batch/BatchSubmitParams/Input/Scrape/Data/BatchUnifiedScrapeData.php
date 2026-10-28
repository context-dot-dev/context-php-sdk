<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\Formats;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\HighlightsParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ImageParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\JsonParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\MarkdownParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\CustomParser;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\PrebuiltParser;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ProductParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ScreenshotParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\SharedParams;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\TimeoutOpts;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\URL;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\Zdr;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Use the same formats and parameters as POST /web/scrape, replacing url with urls. Options apply to every page.
 *
 * @phpstan-import-type ParseParamsVariants from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams
 * @phpstan-import-type FormatsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\Formats
 * @phpstan-import-type URLShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\URL
 * @phpstan-import-type HighlightsParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\HighlightsParams
 * @phpstan-import-type ImageParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ImageParams
 * @phpstan-import-type JsonParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\JsonParams
 * @phpstan-import-type MarkdownParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\MarkdownParams
 * @phpstan-import-type ParseParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams
 * @phpstan-import-type ProductParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ProductParams
 * @phpstan-import-type ScreenshotParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ScreenshotParams
 * @phpstan-import-type SharedParamsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\SharedParams
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\TimeoutOpts
 *
 * @phpstan-type BatchUnifiedScrapeDataShape = array{
 *   formats: Formats|FormatsShape,
 *   urls: list<URL|URLShape>,
 *   highlightsParams?: null|HighlightsParams|HighlightsParamsShape,
 *   imageParams?: null|ImageParams|ImageParamsShape,
 *   jsonParams?: null|JsonParams|JsonParamsShape,
 *   markdownParams?: null|MarkdownParams|MarkdownParamsShape,
 *   maxAgeMs?: int|null,
 *   parseParams?: ParseParamsShape|null,
 *   productParams?: null|ProductParams|ProductParamsShape,
 *   screenshotParams?: null|ScreenshotParams|ScreenshotParamsShape,
 *   sharedParams?: null|SharedParams|SharedParamsShape,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class BatchUnifiedScrapeData implements BaseModel
{
    /** @use SdkModel<BatchUnifiedScrapeDataShape> */
    use SdkModel;

    /**
     * Outputs to return. Set at least one to `true`.
     */
    #[Required]
    public Formats $formats;

    /**
     * Pages to scrape. Maximum 100000.
     *
     * @var list<URL> $urls
     */
    #[Required(list: URL::class)]
    public array $urls;

    /**
     * Requires `formats.highlights: true`; required when it is set.
     */
    #[Optional]
    public ?HighlightsParams $highlightsParams;

    /**
     * Image options. Requires formats.images: true.
     */
    #[Optional]
    public ?ImageParams $imageParams;

    /**
     * Requires `formats.json: true`; required when it is set.
     */
    #[Optional]
    public ?JsonParams $jsonParams;

    /**
     * Markdown options. Requires `formats.markdown`.
     */
    #[Optional]
    public ?MarkdownParams $markdownParams;

    /**
     * Maximum age of a cached output, in milliseconds. `0` fetches fresh. Defaults to 3 days (259200000 ms). Maximum: 1 year (31536000000 ms).
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Requires `formats.parse: true`; required when it is set.
     *
     * @var ParseParamsVariants|null $parseParams
     */
    #[Optional]
    public CustomParser|PrebuiltParser|null $parseParams;

    /**
     * Product options. Requires formats.product: true.
     */
    #[Optional]
    public ?ProductParams $productParams;

    /**
     * Screenshot options. Requires formats.screenshot: true.
     */
    #[Optional]
    public ?ScreenshotParams $screenshotParams;

    /**
     * Browser and content settings shared by all outputs.
     */
    #[Optional]
    public ?SharedParams $sharedParams;

    /**
     * Labels for tracking request usage. Not retained when zdr is enabled.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Deadline for each page, using the same behavior and defaults as POST /web/scrape.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * Batches persist their results. Only disabled is supported; enabled returns ZDR_NOT_SUPPORTED.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new BatchUnifiedScrapeData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchUnifiedScrapeData::with(formats: ..., urls: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchUnifiedScrapeData)->withFormats(...)->withURLs(...)
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
     * @param Formats|FormatsShape $formats
     * @param list<URL|URLShape> $urls
     * @param HighlightsParams|HighlightsParamsShape|null $highlightsParams
     * @param ImageParams|ImageParamsShape|null $imageParams
     * @param JsonParams|JsonParamsShape|null $jsonParams
     * @param MarkdownParams|MarkdownParamsShape|null $markdownParams
     * @param ParseParamsShape|null $parseParams
     * @param ProductParams|ProductParamsShape|null $productParams
     * @param ScreenshotParams|ScreenshotParamsShape|null $screenshotParams
     * @param SharedParams|SharedParamsShape|null $sharedParams
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        Formats|array $formats,
        array $urls,
        HighlightsParams|array|null $highlightsParams = null,
        ImageParams|array|null $imageParams = null,
        JsonParams|array|null $jsonParams = null,
        MarkdownParams|array|null $markdownParams = null,
        ?int $maxAgeMs = null,
        CustomParser|array|PrebuiltParser|null $parseParams = null,
        ProductParams|array|null $productParams = null,
        ScreenshotParams|array|null $screenshotParams = null,
        SharedParams|array|null $sharedParams = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['formats'] = $formats;
        $self['urls'] = $urls;

        null !== $highlightsParams && $self['highlightsParams'] = $highlightsParams;
        null !== $imageParams && $self['imageParams'] = $imageParams;
        null !== $jsonParams && $self['jsonParams'] = $jsonParams;
        null !== $markdownParams && $self['markdownParams'] = $markdownParams;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $parseParams && $self['parseParams'] = $parseParams;
        null !== $productParams && $self['productParams'] = $productParams;
        null !== $screenshotParams && $self['screenshotParams'] = $screenshotParams;
        null !== $sharedParams && $self['sharedParams'] = $sharedParams;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutOpts && $self['timeoutOpts'] = $timeoutOpts;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Outputs to return. Set at least one to `true`.
     *
     * @param Formats|FormatsShape $formats
     */
    public function withFormats(Formats|array $formats): self
    {
        $self = clone $this;
        $self['formats'] = $formats;

        return $self;
    }

    /**
     * Pages to scrape. Maximum 100000.
     *
     * @param list<URL|URLShape> $urls
     */
    public function withURLs(array $urls): self
    {
        $self = clone $this;
        $self['urls'] = $urls;

        return $self;
    }

    /**
     * Requires `formats.highlights: true`; required when it is set.
     *
     * @param HighlightsParams|HighlightsParamsShape $highlightsParams
     */
    public function withHighlightsParams(
        HighlightsParams|array $highlightsParams
    ): self {
        $self = clone $this;
        $self['highlightsParams'] = $highlightsParams;

        return $self;
    }

    /**
     * Image options. Requires formats.images: true.
     *
     * @param ImageParams|ImageParamsShape $imageParams
     */
    public function withImageParams(ImageParams|array $imageParams): self
    {
        $self = clone $this;
        $self['imageParams'] = $imageParams;

        return $self;
    }

    /**
     * Requires `formats.json: true`; required when it is set.
     *
     * @param JsonParams|JsonParamsShape $jsonParams
     */
    public function withJsonParams(JsonParams|array $jsonParams): self
    {
        $self = clone $this;
        $self['jsonParams'] = $jsonParams;

        return $self;
    }

    /**
     * Markdown options. Requires `formats.markdown`.
     *
     * @param MarkdownParams|MarkdownParamsShape $markdownParams
     */
    public function withMarkdownParams(
        MarkdownParams|array $markdownParams
    ): self {
        $self = clone $this;
        $self['markdownParams'] = $markdownParams;

        return $self;
    }

    /**
     * Maximum age of a cached output, in milliseconds. `0` fetches fresh. Defaults to 3 days (259200000 ms). Maximum: 1 year (31536000000 ms).
     */
    public function withMaxAgeMs(int $maxAgeMs): self
    {
        $self = clone $this;
        $self['maxAgeMs'] = $maxAgeMs;

        return $self;
    }

    /**
     * Requires `formats.parse: true`; required when it is set.
     *
     * @param ParseParamsShape $parseParams
     */
    public function withParseParams(
        CustomParser|array|PrebuiltParser $parseParams
    ): self {
        $self = clone $this;
        $self['parseParams'] = $parseParams;

        return $self;
    }

    /**
     * Product options. Requires formats.product: true.
     *
     * @param ProductParams|ProductParamsShape $productParams
     */
    public function withProductParams(ProductParams|array $productParams): self
    {
        $self = clone $this;
        $self['productParams'] = $productParams;

        return $self;
    }

    /**
     * Screenshot options. Requires formats.screenshot: true.
     *
     * @param ScreenshotParams|ScreenshotParamsShape $screenshotParams
     */
    public function withScreenshotParams(
        ScreenshotParams|array $screenshotParams
    ): self {
        $self = clone $this;
        $self['screenshotParams'] = $screenshotParams;

        return $self;
    }

    /**
     * Browser and content settings shared by all outputs.
     *
     * @param SharedParams|SharedParamsShape $sharedParams
     */
    public function withSharedParams(SharedParams|array $sharedParams): self
    {
        $self = clone $this;
        $self['sharedParams'] = $sharedParams;

        return $self;
    }

    /**
     * Labels for tracking request usage. Not retained when zdr is enabled.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Deadline for each page, using the same behavior and defaults as POST /web/scrape.
     *
     * @param TimeoutOpts|TimeoutOptsShape $timeoutOpts
     */
    public function withTimeoutOpts(TimeoutOpts|array $timeoutOpts): self
    {
        $self = clone $this;
        $self['timeoutOpts'] = $timeoutOpts;

        return $self;
    }

    /**
     * Batches persist their results. Only disabled is supported; enabled returns ZDR_NOT_SUPPORTED.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
