<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Outputs to return. Enable at least one; omitted formats are false.
 *
 * @phpstan-type FormatsShape = array{
 *   bytes?: bool|null,
 *   highlights?: bool|null,
 *   html?: bool|null,
 *   images?: bool|null,
 *   json?: bool|null,
 *   markdown?: bool|null,
 *   parse?: bool|null,
 *   product?: bool|null,
 *   screenshot?: bool|null,
 * }
 */
final class Formats implements BaseModel
{
    /** @use SdkModel<FormatsShape> */
    use SdkModel;

    /**
     * The original HTTP response body.
     */
    #[Optional]
    public ?bool $bytes;

    /**
     * Relevant passages for your question or topic. Adds 3 credits.
     */
    #[Optional]
    public ?bool $highlights;

    /**
     * Rendered HTML.
     */
    #[Optional]
    public ?bool $html;

    /**
     * Images found on the page.
     */
    #[Optional]
    public ?bool $images;

    /**
     * Page data extracted using your schema. Adds 4 credits.
     */
    #[Optional]
    public ?bool $json;

    /**
     * Page content as Markdown.
     */
    #[Optional]
    public ?bool $markdown;

    /**
     * Fields selected by parseParams.rules.
     */
    #[Optional]
    public ?bool $parse;

    /**
     * Product details such as name, price, and availability. Adds 1 credit.
     */
    #[Optional]
    public ?bool $product;

    /**
     * An inline image of the page.
     */
    #[Optional]
    public ?bool $screenshot;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $bytes = null,
        ?bool $highlights = null,
        ?bool $html = null,
        ?bool $images = null,
        ?bool $json = null,
        ?bool $markdown = null,
        ?bool $parse = null,
        ?bool $product = null,
        ?bool $screenshot = null,
    ): self {
        $self = new self;

        null !== $bytes && $self['bytes'] = $bytes;
        null !== $highlights && $self['highlights'] = $highlights;
        null !== $html && $self['html'] = $html;
        null !== $images && $self['images'] = $images;
        null !== $json && $self['json'] = $json;
        null !== $markdown && $self['markdown'] = $markdown;
        null !== $parse && $self['parse'] = $parse;
        null !== $product && $self['product'] = $product;
        null !== $screenshot && $self['screenshot'] = $screenshot;

        return $self;
    }

    /**
     * The original HTTP response body.
     */
    public function withBytes(bool $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Relevant passages for your question or topic. Adds 3 credits.
     */
    public function withHighlights(bool $highlights): self
    {
        $self = clone $this;
        $self['highlights'] = $highlights;

        return $self;
    }

    /**
     * Rendered HTML.
     */
    public function withHTML(bool $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * Images found on the page.
     */
    public function withImages(bool $images): self
    {
        $self = clone $this;
        $self['images'] = $images;

        return $self;
    }

    /**
     * Page data extracted using your schema. Adds 4 credits.
     */
    public function withJson(bool $json): self
    {
        $self = clone $this;
        $self['json'] = $json;

        return $self;
    }

    /**
     * Page content as Markdown.
     */
    public function withMarkdown(bool $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Fields selected by parseParams.rules.
     */
    public function withParse(bool $parse): self
    {
        $self = clone $this;
        $self['parse'] = $parse;

        return $self;
    }

    /**
     * Product details such as name, price, and availability. Adds 1 credit.
     */
    public function withProduct(bool $product): self
    {
        $self = clone $this;
        $self['product'] = $product;

        return $self;
    }

    /**
     * An inline image of the page.
     */
    public function withScreenshot(bool $screenshot): self
    {
        $self = clone $this;
        $self['screenshot'] = $screenshot;

        return $self;
    }
}
