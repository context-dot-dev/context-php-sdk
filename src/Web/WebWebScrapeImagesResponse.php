<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebScrapeImagesResponse\Image;
use ContextDev\Web\WebWebScrapeImagesResponse\KeyMetadata;

/**
 * @phpstan-import-type ImageShape from \ContextDev\Web\WebWebScrapeImagesResponse\Image
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebScrapeImagesResponse\KeyMetadata
 *
 * @phpstan-type WebWebScrapeImagesResponseShape = array{
 *   images: list<Image|ImageShape>,
 *   success: bool,
 *   url: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebScrapeImagesResponse implements BaseModel
{
    /** @use SdkModel<WebWebScrapeImagesResponseShape> */
    use SdkModel;

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
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebScrapeImagesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebScrapeImagesResponse::with(images: ..., success: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebScrapeImagesResponse)
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
     * @param list<Image|ImageShape> $images
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $images,
        bool $success,
        string $url,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['images'] = $images;
        $self['success'] = $success;
        $self['url'] = $url;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
