<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\Formats;
use ContextDev\Web\WebScrapeParams\ImageParams;
use ContextDev\Web\WebScrapeParams\MarkdownParams;
use ContextDev\Web\WebScrapeParams\ParseParams;
use ContextDev\Web\WebScrapeParams\ScreenshotParams;
use ContextDev\Web\WebScrapeParams\SharedParams;
use ContextDev\Web\WebScrapeParams\Zdr;

/**
 * Reuse cached outputs independently and capture missing formats in one page visit. Each cache key includes only the settings that affect that output. HTML is shared with Markdown and parsed fields. Cached outputs can come from different visits within maxAgeMs; use 0 for a fresh capture. HTML-only requests use the existing fast acquisition path. One credit per request, including cache hits, or two with browser actions; PDF OCR adds one credit per recovered page on fresh extraction. Original response bytes and screenshots are limited to 20 MiB each, screenshots to 40 megapixels, and the combined browser capture to 60 MiB.
 *
 * @see ContextDev\Services\WebService::scrape()
 *
 * @phpstan-import-type FormatsShape from \ContextDev\Web\WebScrapeParams\Formats
 * @phpstan-import-type ImageParamsShape from \ContextDev\Web\WebScrapeParams\ImageParams
 * @phpstan-import-type MarkdownParamsShape from \ContextDev\Web\WebScrapeParams\MarkdownParams
 * @phpstan-import-type ParseParamsShape from \ContextDev\Web\WebScrapeParams\ParseParams
 * @phpstan-import-type ScreenshotParamsShape from \ContextDev\Web\WebScrapeParams\ScreenshotParams
 * @phpstan-import-type SharedParamsShape from \ContextDev\Web\WebScrapeParams\SharedParams
 *
 * @phpstan-type WebScrapeParamsShape = array{
 *   formats: Formats|FormatsShape,
 *   url: string,
 *   imageParams?: null|ImageParams|ImageParamsShape,
 *   markdownParams?: null|MarkdownParams|MarkdownParamsShape,
 *   maxAgeMs?: int|null,
 *   parseParams?: null|ParseParams|ParseParamsShape,
 *   screenshotParams?: null|ScreenshotParams|ScreenshotParamsShape,
 *   sharedParams?: null|SharedParams|SharedParamsShape,
 *   tags?: list<string>|null,
 *   timeoutMs?: int|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class WebScrapeParams implements BaseModel
{
    /** @use SdkModel<WebScrapeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Outputs to return. Enable at least one; omitted formats are false.
     */
    #[Required]
    public Formats $formats;

    /**
     * The URL to scrape.
     */
    #[Required]
    public string $url;

    /**
     * Image options. Requires formats.images: true.
     */
    #[Optional]
    public ?ImageParams $imageParams;

    /**
     * Markdown options. Requires formats.markdown: true.
     */
    #[Optional]
    public ?MarkdownParams $markdownParams;

    /**
     * Maximum age of each cached output. Defaults to 1 day; 0 fetches fresh and updates the requested outputs. Compatible outputs are shared with the individual scrape endpoints. Image results with hosted files refresh after 23 hours; other outputs retain their own freshness.
     */
    #[Optional]
    public ?int $maxAgeMs;

    /**
     * Required when formats.parse is true.
     */
    #[Optional]
    public ?ParseParams $parseParams;

    /**
     * Screenshot options. Requires formats.screenshot: true.
     */
    #[Optional]
    public ?ScreenshotParams $screenshotParams;

    /**
     * Shared browser and content settings. Content filters leave screenshots and original bytes unchanged.
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
     * Total deadline, including navigation, actions, waiting, and all outputs.
     */
    #[Optional]
    public ?int $timeoutMs;

    /**
     * Zero data retention. Bypasses caches and uploads; excludes request/response content and tags from logs. Must be enabled for your organization.
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
     * @param ImageParams|ImageParamsShape|null $imageParams
     * @param MarkdownParams|MarkdownParamsShape|null $markdownParams
     * @param ParseParams|ParseParamsShape|null $parseParams
     * @param ScreenshotParams|ScreenshotParamsShape|null $screenshotParams
     * @param SharedParams|SharedParamsShape|null $sharedParams
     * @param list<string>|null $tags
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        Formats|array $formats,
        string $url,
        ImageParams|array|null $imageParams = null,
        MarkdownParams|array|null $markdownParams = null,
        ?int $maxAgeMs = null,
        ParseParams|array|null $parseParams = null,
        ScreenshotParams|array|null $screenshotParams = null,
        SharedParams|array|null $sharedParams = null,
        ?array $tags = null,
        ?int $timeoutMs = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['formats'] = $formats;
        $self['url'] = $url;

        null !== $imageParams && $self['imageParams'] = $imageParams;
        null !== $markdownParams && $self['markdownParams'] = $markdownParams;
        null !== $maxAgeMs && $self['maxAgeMs'] = $maxAgeMs;
        null !== $parseParams && $self['parseParams'] = $parseParams;
        null !== $screenshotParams && $self['screenshotParams'] = $screenshotParams;
        null !== $sharedParams && $self['sharedParams'] = $sharedParams;
        null !== $tags && $self['tags'] = $tags;
        null !== $timeoutMs && $self['timeoutMs'] = $timeoutMs;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Outputs to return. Enable at least one; omitted formats are false.
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
     * The URL to scrape.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

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
     * Markdown options. Requires formats.markdown: true.
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
     * Maximum age of each cached output. Defaults to 1 day; 0 fetches fresh and updates the requested outputs. Compatible outputs are shared with the individual scrape endpoints. Image results with hosted files refresh after 23 hours; other outputs retain their own freshness.
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
     * Shared browser and content settings. Content filters leave screenshots and original bytes unchanged.
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
     * Total deadline, including navigation, actions, waiting, and all outputs.
     */
    public function withTimeoutMs(int $timeoutMs): self
    {
        $self = clone $this;
        $self['timeoutMs'] = $timeoutMs;

        return $self;
    }

    /**
     * Zero data retention. Bypasses caches and uploads; excludes request/response content and tags from logs. Must be enabled for your organization.
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
