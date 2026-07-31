<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeMdResponse\ActionsApplied;
use ContextDev\Web\WebWebScrapeMdResponse\KeyMetadata;
use ContextDev\Web\WebWebScrapeMdResponse\Metadata;

/**
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebWebScrapeMdResponse\Metadata
 * @phpstan-import-type ActionsAppliedShape from \ContextDev\Web\WebWebScrapeMdResponse\ActionsApplied
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeMdResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeMdResponseShape = array{
 *   contentLength: int,
 *   markdown: string,
 *   metadata: Metadata|MetadataShape,
 *   success: bool,
 *   url: string,
 *   actionsApplied?: list<ActionsApplied|ActionsAppliedShape>|null,
 *   actionsHTMLStale?: bool|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeMdResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeMdResponseShape> */
    use SdkModel;

    /**
     * UTF-8 byte length of the returned Markdown. Use 0 to identify an empty result and compare small values against your workload's minimum useful-content threshold.
     */
    #[Required]
    public int $contentLength;

    /**
     * Page content converted to GitHub Flavored Markdown.
     */
    #[Required]
    public string $markdown;

    /**
     * Metadata extracted from the scraped page HTML.
     */
    #[Required]
    public Metadata $metadata;

    /**
     * Indicates success.
     */
    #[Required]
    public bool $success;

    /**
     * The URL that was scraped.
     */
    #[Required]
    public string $url;

    /**
     * One verified outcome per requested browser action, in request order.
     *
     * @var list<ActionsApplied>|null $actionsApplied
     */
    #[Optional(list: ActionsApplied::class)]
    public ?array $actionsApplied;

    /**
     * True when an action was applied but the returned content could not be refreshed afterward.
     */
    #[Optional('actionsHtmlStale')]
    public ?bool $actionsHTMLStale;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeMdResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeMdResponse::with(
     *   contentLength: ..., markdown: ..., metadata: ..., success: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeMdResponse)
     *   ->withContentLength(...)
     *   ->withMarkdown(...)
     *   ->withMetadata(...)
     *   ->withSuccess(...)
     *   ->withURL(...)
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
     * @param Metadata|MetadataShape $metadata
     * @param list<ActionsApplied|ActionsAppliedShape>|null $actionsApplied
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        int $contentLength,
        string $markdown,
        Metadata|array $metadata,
        bool $success,
        string $url,
        ?array $actionsApplied = null,
        ?bool $actionsHTMLStale = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['contentLength'] = $contentLength;
        $self['markdown'] = $markdown;
        $self['metadata'] = $metadata;
        $self['success'] = $success;
        $self['url'] = $url;

        null !== $actionsApplied && $self['actionsApplied'] = $actionsApplied;
        null !== $actionsHTMLStale && $self['actionsHTMLStale'] = $actionsHTMLStale;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * UTF-8 byte length of the returned Markdown. Use 0 to identify an empty result and compare small values against your workload's minimum useful-content threshold.
     */
    public function withContentLength(int $contentLength): self
    {
        $self = clone $this;
        $self['contentLength'] = $contentLength;

        return $self;
    }

    /**
     * Page content converted to GitHub Flavored Markdown.
     */
    public function withMarkdown(string $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Metadata extracted from the scraped page HTML.
     *
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Indicates success.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * The URL that was scraped.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * One verified outcome per requested browser action, in request order.
     *
     * @param list<ActionsApplied|ActionsAppliedShape> $actionsApplied
     */
    public function withActionsApplied(array $actionsApplied): self
    {
        $self = clone $this;
        $self['actionsApplied'] = $actionsApplied;

        return $self;
    }

    /**
     * True when an action was applied but the returned content could not be refreshed afterward.
     */
    public function withActionsHTMLStale(bool $actionsHTMLStale): self
    {
        $self = clone $this;
        $self['actionsHTMLStale'] = $actionsHTMLStale;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }
}
