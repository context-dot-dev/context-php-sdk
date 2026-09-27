<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\Formats;
use ContextDev\Web\WebScrapeParams\HighlightsParams;
use ContextDev\Web\WebScrapeParams\ImageParams;
use ContextDev\Web\WebScrapeParams\JsonParams;
use ContextDev\Web\WebScrapeParams\MarkdownParams;
use ContextDev\Web\WebScrapeParams\ParseParams;
use ContextDev\Web\WebScrapeParams\ProductParams;
use ContextDev\Web\WebScrapeParams\ScreenshotParams;
use ContextDev\Web\WebScrapeParams\SharedParams;
use ContextDev\Web\WebScrapeParams\TimeoutOpts;
use ContextDev\Web\WebScrapeParams\Zdr;

/**
 * Returns the outputs you enable in `formats` from one visit to a URL. Each output reports its own `success`, so a failed output does not fail the request.
 *
 * @see ContextDev\Services\WebService::scrape()
 *
 * @phpstan-import-type FormatsShape from \ContextDev\Web\WebScrapeParams\Formats
 * @phpstan-import-type HighlightsParamsShape from \ContextDev\Web\WebScrapeParams\HighlightsParams
 * @phpstan-import-type ImageParamsShape from \ContextDev\Web\WebScrapeParams\ImageParams
 * @phpstan-import-type JsonParamsShape from \ContextDev\Web\WebScrapeParams\JsonParams
 * @phpstan-import-type MarkdownParamsShape from \ContextDev\Web\WebScrapeParams\MarkdownParams
 * @phpstan-import-type ParseParamsShape from \ContextDev\Web\WebScrapeParams\ParseParams
 * @phpstan-import-type ProductParamsShape from \ContextDev\Web\WebScrapeParams\ProductParams
 * @phpstan-import-type ScreenshotParamsShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams
 * @phpstan-import-type SharedParamsShape from \ContextDev\Web\WebScrapeParams\SharedParams
 * @phpstan-import-type TimeoutOptsShape from \ContextDev\Web\WebScrapeParams\TimeoutOpts
 *
 * @phpstan-type WebScrapeParamsShape = array{
 *   formats: Formats|FormatsShape,
 *   url: string,
 *   highlightsParams?: null|HighlightsParams|HighlightsParamsShape,
 *   imageParams?: null|ImageParams|ImageParamsShape,
 *   jsonParams?: null|JsonParams|JsonParamsShape,
 *   markdownParams?: null|MarkdownParams|MarkdownParamsShape,
 *   maxAgeMs?: int|null,
 *   parseParams?: null|ParseParams|ParseParamsShape,
 *   productParams?: null|ProductParams|ProductParamsShape,
 *   screenshotParams?: null|ScreenshotParams|ScreenshotParamsShape,
 *   sharedParams?: null|SharedParams|SharedParamsShape,
 *   tags?: list<string>|null,
 *   timeoutOpts?: null|TimeoutOpts|TimeoutOptsShape,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebScrapeParams implements BaseModel
{
    /** @use SdkModel<WebScrapeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Outputs to return. Set at least one to `true`.
     */
    #[Required]
    public Formats $formats;

    /**
     * Public HTTP or HTTPS URL to scrape.
     */
    #[Required]
    public string $url;

    /**
     * Required when `formats.highlights` is `true`.
     */
    #[Optional]
    public ?HighlightsParams $highlightsParams;

    /**
     * Image options. Requires formats.images: true.
     */
    #[Optional]
    public ?ImageParams $imageParams;

    /**
     * Required when formats.json is true.
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
     * Required when formats.parse is true.
     */
    #[Optional]
    public ?ParseParams $parseParams;

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
     * Deadline for the whole request. Defaults to 60000 ms with `fail`. Fixed waits must end before it.
     */
    #[Optional]
    public ?TimeoutOpts $timeoutOpts;

    /**
     * `enabled` turns on zero data retention. Your organization must have ZDR enabled.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

    /**
     * `new WebScrapeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebScrapeParams::with(formats: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebScrapeParams)->withFormats(...)->withURL(...)
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
     * @param HighlightsParams|HighlightsParamsShape|null $highlightsParams
     * @param ImageParams|ImageParamsShape|null $imageParams
     * @param JsonParams|JsonParamsShape|null $jsonParams
     * @param MarkdownParams|MarkdownParamsShape|null $markdownParams
     * @param ParseParams|ParseParamsShape|null $parseParams
     * @param ProductParams|ProductParamsShape|null $productParams
     * @param ScreenshotParams|ScreenshotParamsShape|null $screenshotParams
     * @param SharedParams|SharedParamsShape|null $sharedParams
     * @param list<string>|null $tags
     * @param TimeoutOpts|TimeoutOptsShape|null $timeoutOpts
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        Formats|array $formats,
        string $url,
        HighlightsParams|array|null $highlightsParams = null,
        ImageParams|array|null $imageParams = null,
        JsonParams|array|null $jsonParams = null,
        MarkdownParams|array|null $markdownParams = null,
        ?int $maxAgeMs = null,
        ParseParams|array|null $parseParams = null,
        ProductParams|array|null $productParams = null,
        ScreenshotParams|array|null $screenshotParams = null,
        SharedParams|array|null $sharedParams = null,
        ?array $tags = null,
        TimeoutOpts|array|null $timeoutOpts = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['formats'] = $formats;
        $self['url'] = $url;

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
     * Public HTTP or HTTPS URL to scrape.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Required when `formats.highlights` is `true`.
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
     * Required when formats.json is true.
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
     * Required when formats.parse is true.
     *
     * @param ParseParams|ParseParamsShape $parseParams
     */
    public function withParseParams(ParseParams|array $parseParams): self
    {
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
     * Deadline for the whole request. Defaults to 60000 ms with `fail`. Fixed waits must end before it.
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
     * `enabled` turns on zero data retention. Your organization must have ZDR enabled.
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
