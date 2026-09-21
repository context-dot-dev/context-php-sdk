<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\MarkdownParams\InlineImages;

/**
 * Markdown options. Requires formats.markdown: true.
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

    #[Optional]
    public ?bool $includeImages;

    #[Optional]
    public ?bool $includeLinks;

    /**
     * Base64 images use placeholders by default. Requires includeImages: true.
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

    public function withIncludeImages(bool $includeImages): self
    {
        $self = clone $this;
        $self['includeImages'] = $includeImages;

        return $self;
    }

    public function withIncludeLinks(bool $includeLinks): self
    {
        $self = clone $this;
        $self['includeLinks'] = $includeLinks;

        return $self;
    }

    /**
     * Base64 images use placeholders by default. Requires includeImages: true.
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
