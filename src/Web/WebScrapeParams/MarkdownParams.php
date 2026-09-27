<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\MarkdownParams\InlineImages;

/**
 * Markdown options. Requires `formats.markdown`.
 *
 * @phpstan-type MarkdownParamsShape = array{
 *   includeImages?: bool|null,
 *   includeLinks?: bool|null,
 *   inlineImages?: null|InlineImages|value-of<InlineImages>,
 * }
 */
final class MarkdownParams implements BaseModel
{
    /** @use SdkModel<MarkdownParamsShape> */
    use SdkModel;

    /**
     * Include images in the Markdown using image syntax with URLs and alt text.
     */
    #[Optional]
    public ?bool $includeImages;

    /**
     * Keep link URLs in the Markdown. Set false to return link text without URLs.
     */
    #[Optional]
    public ?bool $includeLinks;

    /**
     * How base64 images appear: `placeholder` (default) or `preserve`. Requires `includeImages`.
     *
     * @var value-of<InlineImages>|null $inlineImages
     */
    #[Optional(enum: InlineImages::class)]
    public ?string $inlineImages;

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
     */
    public static function with(
        ?bool $includeImages = null,
        ?bool $includeLinks = null,
        InlineImages|string|null $inlineImages = null,
    ): self {
        $self = new self;

        null !== $includeImages && $self['includeImages'] = $includeImages;
        null !== $includeLinks && $self['includeLinks'] = $includeLinks;
        null !== $inlineImages && $self['inlineImages'] = $inlineImages;

        return $self;
    }

    /**
     * Include images in the Markdown using image syntax with URLs and alt text.
     */
    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    /**
     * Keep link URLs in the Markdown. Set false to return link text without URLs.
     */
    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * How base64 images appear: `placeholder` (default) or `preserve`. Requires `includeImages`.
     *
     * @param InlineImages|value-of<InlineImages> $inlineImages
     */
    public function withInlineImages(InlineImages|string $inlineImages): self
    {
        $self = clone $this;
        $self['inlineImages'] = $inlineImages;

        return $self;
    }
}
