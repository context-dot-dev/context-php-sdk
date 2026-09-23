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
 *   html?: bool|null,
 *   images?: bool|null,
 *   json?: bool|null,
 *   markdown?: bool|null,
 *   parse?: bool|null,
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
     * Page data extracted by an LLM from the page Markdown into jsonParams.schema; values carried only in attributes or CSS classes need formats.parse instead. Adds four credits when the page has text to extract; when shared content filters leave no text the result is an empty object and only the base price applies.
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
        ?bool $html = null,
        ?bool $images = null,
        ?bool $json = null,
        ?bool $markdown = null,
        ?bool $parse = null,
        ?bool $screenshot = null,
    ): self {
        $self = new self;

        null !== $bytes && $self['bytes'] = $bytes;
        null !== $html && $self['html'] = $html;
        null !== $images && $self['images'] = $images;
        null !== $json && $self['json'] = $json;
        null !== $markdown && $self['markdown'] = $markdown;
        null !== $parse && $self['parse'] = $parse;
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
     * Page data extracted by an LLM from the page Markdown into jsonParams.schema; values carried only in attributes or CSS classes need formats.parse instead. Adds four credits when the page has text to extract; when shared content filters leave no text the result is an empty object and only the base price applies.
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
     * An inline image of the page.
     */
    public function withScreenshot(bool $screenshot): self
    {
        $self = clone $this;
        $self['screenshot'] = $screenshot;

        return $self;
    }
}
