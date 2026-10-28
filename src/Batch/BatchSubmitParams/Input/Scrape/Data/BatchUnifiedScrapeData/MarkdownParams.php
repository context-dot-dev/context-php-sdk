<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\MarkdownParams\InlineImages;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\MarkdownParams\SourcePreference;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Markdown options. Requires `formats.markdown`.
 *
 * @phpstan-type MarkdownParamsShape = array{
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   inlineImages?: null|InlineImages|value-of<InlineImages>,
 *   sourcePreference?: list<SourcePreference|value-of<SourcePreference>>|null,
 * }
 */
final class MarkdownParams implements BaseModel
{
    /** @use SdkModel<MarkdownParamsShape> */
    use SdkModel;

    /**
     * Include images in the Markdown (`html-conversion` only).
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Keep link URLs in the Markdown (`html-conversion` only).
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * How base64 images appear when `includeImages` is set (`html-conversion` only).
     *
     * @var value-of<InlineImages>|null $inlineImages
     */
    #[Optional(enum: InlineImages::class)]
    public ?string $inlineImages;

    /**
     * Markdown sources in order of preference: `html-conversion` converts the page HTML, `markdown-direct` uses Markdown the site publishes.
     *
     * @var list<value-of<SourcePreference>>|null $sourcePreference
     */
    #[Optional(list: SourcePreference::class)]
    public ?array $sourcePreference;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param InlineImages|value-of<InlineImages>|null $inlineImages
     * @param list<SourcePreference|value-of<SourcePreference>>|null $sourcePreference
     */
    public static function with(
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        InlineImages|string|null $inlineImages = null,
        ?array $sourcePreference = null,
    ): self {
        $self = new self;

        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $inlineImages && $self['inlineImages'] = $inlineImages;
        null !== $sourcePreference && $self['sourcePreference'] = $sourcePreference;

        return $self;
    }

    /**
     * Include images in the Markdown (`html-conversion` only).
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Keep link URLs in the Markdown (`html-conversion` only).
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * How base64 images appear when `includeImages` is set (`html-conversion` only).
     *
     * @param InlineImages|value-of<InlineImages> $inlineImages
     */
    public function withInlineImages(InlineImages|string $inlineImages): self
    {
        $self = clone $this;
        $self['inlineImages'] = $inlineImages;

        return $self;
    }

    /**
     * Markdown sources in order of preference: `html-conversion` converts the page HTML, `markdown-direct` uses Markdown the site publishes.
     *
     * @param list<SourcePreference|value-of<SourcePreference>> $sourcePreference
     */
    public function withSourcePreference(array $sourcePreference): self
    {
        $self = clone $this;
        $self['sourcePreference'] = $sourcePreference;

        return $self;
    }
}
