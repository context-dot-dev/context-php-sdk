<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesResponse\ActionsApplied;
use ContextDev\Web\WebWebScrapeImagesResponse\CacheMetadata;
use ContextDev\Web\WebWebScrapeImagesResponse\Image;
use ContextDev\Web\WebWebScrapeImagesResponse\KeyMetadata;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebWebScrapeImagesResponse\CacheMetadata
 * @phpstan-import-type ImageShape from \ContextDev\Web\WebWebScrapeImagesResponse\Image
 * @phpstan-import-type ActionsAppliedShape from \ContextDev\Web\WebWebScrapeImagesResponse\ActionsApplied
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeImagesResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeImagesResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   images: list<Image|ImageShape>,
 *   success: bool,
 *   url: string,
 *   actionsApplied?: list<ActionsApplied|ActionsAppliedShape>|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeImagesResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeImagesResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Images found on the page.
     *
     * @var list<Image> $images
     */
    #[Required(list: Image::class)]
    public array $images;

    /**
     * Always true on success.
     */
    #[Required]
    public bool $success;

    /**
     * Page URL that was scraped.
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
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeImagesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeImagesResponse::with(
     *   cacheMetadata: ..., images: ..., success: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeImagesResponse)
     *   ->withCacheMetadata(...)
     *   ->withImages(...)
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
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     * @param list<Image|ImageShape> $images
     * @param list<ActionsApplied|ActionsAppliedShape>|null $actionsApplied
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        array $images,
        bool $success,
        string $url,
        ?array $actionsApplied = null,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['images'] = $images;
        $self['success'] = $success;
        $self['url'] = $url;

        null !== $actionsApplied && $self['actionsApplied'] = $actionsApplied;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     *
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     */
    public function withCacheMetadata(CacheMetadata|array $cacheMetadata): self
    {
        $self = clone $this;
        $self['cacheMetadata'] = $cacheMetadata;

        return $self;
    }

    /**
     * Images found on the page.
     *
     * @param list<Image|ImageShape> $images
     */
    public function withImages(array $images): self
    {
        $self = clone $this;
        $self['images'] = $images;

        return $self;
    }

    /**
     * Always true on success.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Page URL that was scraped.
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
