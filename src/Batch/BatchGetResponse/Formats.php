<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Formats requested for each page, as submitted in `input.data.formats`.
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
     * Return the original HTTP response body.
     */
    #[Optional]
    public ?bool $bytes;

    /**
     * Return Markdown excerpts relevant to `highlightsParams.query`.
     */
    #[Optional]
    public ?bool $highlights;

    /**
     * Return the rendered HTML.
     */
    #[Optional]
    public ?bool $html;

    /**
     * Return the images found on the page.
     */
    #[Optional]
    public ?bool $images;

    /**
     * Return an object matching `jsonParams.schema`, extracted from the page text and embedded data such as JSON-LD, meta tags, and framework state.
     */
    #[Optional]
    public ?bool $json;

    /**
     * Return the page content, or a video transcript, as Markdown.
     */
    #[Optional]
    public ?bool $markdown;

    /**
     * Return fields extracted with custom rules or a prebuilt parser, as `parsed`.
     */
    #[Optional]
    public ?bool $parse;

    /**
     * Return product details such as name, price, and availability.
     */
    #[Optional]
    public ?bool $product;

    /**
     * Return a screenshot of the page.
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
     * Return the original HTTP response body.
     */
    public function withBytes(bool $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Return Markdown excerpts relevant to `highlightsParams.query`.
     */
    public function withHighlights(bool $highlights): self
    {
        $self = clone $this;
        $self['highlights'] = $highlights;

        return $self;
    }

    /**
     * Return the rendered HTML.
     */
    public function withHTML(bool $html): self
    {
        $self = clone $this;
        $self['html'] = $html;

        return $self;
    }

    /**
     * Return the images found on the page.
     */
    public function withImages(bool $images): self
    {
        $self = clone $this;
        $self['images'] = $images;

        return $self;
    }

    /**
     * Return an object matching `jsonParams.schema`, extracted from the page text and embedded data such as JSON-LD, meta tags, and framework state.
     */
    public function withJson(bool $json): self
    {
        $self = clone $this;
        $self['json'] = $json;

        return $self;
    }

    /**
     * Return the page content, or a video transcript, as Markdown.
     */
    public function withMarkdown(bool $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Return fields extracted with custom rules or a prebuilt parser, as `parsed`.
     */
    public function withParse(bool $parse): self
    {
        $self = clone $this;
        $self['parse'] = $parse;

        return $self;
    }

    /**
     * Return product details such as name, price, and availability.
     */
    public function withProduct(bool $product): self
    {
        $self = clone $this;
        $self['product'] = $product;

        return $self;
    }

    /**
     * Return a screenshot of the page.
     */
    public function withScreenshot(bool $screenshot): self
    {
        $self = clone $this;
        $self['screenshot'] = $screenshot;

        return $self;
    }
}
